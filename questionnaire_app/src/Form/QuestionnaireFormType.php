<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionnaireFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('instructorName', TextType::class, [
              'label' => 'Instructor Name',
              'required' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('crn', TextType::class, [
              'label' => 'CRN',
              'required' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('courseName', TextType::class, [
              'required' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('courseNumber', TextType::class, [
              'required' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('courseSection', TextType::class, [
                'required' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('studentContact', ChoiceType::class, [
              'choices' => [
                'Email' => 'email',
                'UMLearn' => 'umlearn',
                'Scheduled Virtual Office Hours' => 'office_hours',
                'Other' => 'other',
              ],
              'required' => true,
              'multiple' => true,
              'expanded' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('studentContactAdditional', TextType::class)
            ->add('classTimes', ChoiceType::class, [
              'choices' => [
                'Synchronous - Students are expected to be online during the scheduled class times' => 'sync',
                'Asynchronous - Lectures have been recorded and are available to be watched in ' => 'async',
                'Combination of both' => 'combo',
              ],
              'required' => true,
              'expanded' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('classTimesAdditional', TextType::class,
              [
                'label_attr' => [
                  'class' => 'question',
                ],
              ])
            ->add('classParticipation', TextareaType::class,
              [
                'label_attr' => [
                  'class' => 'question',
                ],
              ])
            ->add('recommendedText', TextType::class,
              [
                'label_attr' => [
                  'class' => 'question',
                ],
              ])
            ->add('recommendedTextLocation', ChoiceType::class, [
              'choices' => [
                'Bookstore' => 'bookstore',
                'Library' => 'library',
              ],
              'multiple' => true,
              'expanded' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
            ->add('assessments', ChoiceType::class, [
              'label' => 'Course will consist of',
              'help' => 'choose as many as are appropriate',
              'choices' => [
                'Quizz(es)' => 'quiz',
                'Essay(s)' => 'essay',
                'Mid-Term Exam' => 'midterm',
                'Presentation(s)' => 'present',
                'Final Exam' => 'final',
                'Other' => 'other',
              ],
              'multiple' => true,
              'expanded' => true,
              'label_attr' => [
                'class' => 'question',
              ],
            ])
          ->add('save', SubmitType::class, [
            'label' => 'Send syllabus',
          ]);
    }

}