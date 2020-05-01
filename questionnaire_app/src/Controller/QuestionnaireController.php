<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

class QuestionnaireController extends AbstractController
{

    /**
     * @var string
     */
    private $outputDirectory = __DIR__ . "/../../var/log";

    /**
     * The full path to the response file.
     *
     * @var string
     */
    private $outputfilename;

    /**
     * Maximum attempts to get an exclusive write lock before failing.
     */
    const MAX_LOCK_ATTEMPTS = 10;

    const SUCCESS_TEMPLATE = 'success.html.twig';

    const FORM_TEMPLATE = 'whole_form.html.twig';

    /**
     * Calculate the filename location using the parameters
     *
     * @return string
     */
    public function getFilename()
    {
        if (!isset($this->outputfilename)) {
            $this->outputDirectory = realpath($this->outputDirectory);
            $filename = $this->getParameter('output_filename');
            if (substr($filename, 0, 1) != DIRECTORY_SEPARATOR) {
                $this->outputfilename = $this->outputDirectory . "/" . $filename;
            }
        }
        return $this->outputfilename;
    }

    /**
     * The survey page.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception if we can't get a write lock on the data file.
     */
    public function new(Request $request)
    {
        // Name of the questionnaire data class
        $dataClassName = $this->getParameter('data_class');
        // Name of the questionnaire form class
        $formClassName = $this->getParameter('form_class');
        // Name of the form twig template
        try {
            $template = $this->getParameter('form_twig_template');
            if (!isset($template)) {
                $template = QuestionnaireController::FORM_TEMPLATE;
            }
        } catch (\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException $e) {
            // If the template is not defined then use the default.
            $template = QuestionnaireController::FORM_TEMPLATE;
        }

        $data = new $dataClassName;

        $form = $this->createForm($formClassName, $data);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $data->getData();
            if (!file_exists($this->getFilename())) {
                $headers = array_keys($data);
                $fp = fopen($this->getFilename(), 'w+');
                $this->getLock($fp);
                fwrite($fp, implode(",", $headers) . PHP_EOL);
                fflush($fp); // flush output before releasing the lock
                $this->releaseLock($fp);
                fclose($fp);
            }
            $values = array_values($data);
            // Flatten multiple choice answers to a single string.
            array_walk($values, function (&$o) {
                if (is_array($o)) {
                    $o = implode(" | ", $o);
                }
            });
            $fp = fopen($this->getFilename(), "a");
            $this->getLock($fp);
            fwrite($fp, implode(", ", $values) . PHP_EOL);
            fflush($fp);
            $this->releaseLock($fp);
            fclose($fp);

            return $this->redirectToRoute('submit_success');
        }

        return $this->render($template, [
          'form' => $form->createView(),
        ]);

    }

    /**
     * Function to get an exclusive write lock to the output file.
     *
     * @param $fp \Resource the file pointer
     * @throws \Exception if we can't get a lock after 20 seconds
     */
    private function getLock($fp)
    {
        $fl_result = flock($fp, LOCK_EX);
        if ($fl_result) {
            return;
        }
        $attempts = 0;
        do {
            sleep(2);
            $attempts += 1;
            $fl_result = flock($fp, LOCK_EX);
        } while ($attempts < QuestionnaireController::MAX_LOCK_ATTEMPTS && !$fl_result);
        if (!$fl_result) {
            fclose($fp);
            throw new \Exception("Unable to acquire a write lock");
        } else {
            return;
        }
    }

    /**
     * Release the lock
     *
     * @param $fp \Resource the file pointer
     */
    private function releaseLock($fp)
    {
        flock($fp, LOCK_UN);
    }

    /**
     * Return the success page.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function success(Request $request)
    {
        try {
            $template = $this->getParameter('success_twig_template');
            if (!isset($template)) {
                $template = QuestionnaireController::SUCCESS_TEMPLATE;
            }
        } catch (InvalidArgumentException $e) {
            $template = QuestionnaireController::SUCCESS_TEMPLATE;
        }
        return $this->render($template);
    }
}