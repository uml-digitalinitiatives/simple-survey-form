<?php

namespace App\Datatypes;

/**
 * A mini syllabus survey data structure.
 * @package App\Datatypes
 */
class QuestionnaireData
{

    private $instructorName;
    private $crn;
    private $courseName;
    private $courseNumber;
    private $courseSection;
    private $studentContact;
    private $studentContactAdditional;
    private $classTimes;
    private $classTimesAdditional;
    private $classParticipation;
    private $recommendedText;
    private $recommendedTextLocation;
    private $assessments;

    /**
     * Return survey fields and data.
     * @return array
     */
    public function getData() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * @return mixed
     */
    public function getStudentContactAdditional()
    {
        return $this->studentContactAdditional;
    }

    /**
     * @param mixed $studentContactAdditional
     */
    public function setStudentContactAdditional($studentContactAdditional): void
    {
        $this->studentContactAdditional = $studentContactAdditional;
    }

    /**
     * @return mixed
     */
    public function getClassTimesAdditional()
    {
        return $this->classTimesAdditional;
    }

    /**
     * @param mixed $classTimesAdditional
     */
    public function setClassTimesAdditional($classTimesAdditional): void
    {
        $this->classTimesAdditional = $classTimesAdditional;
    }

    /**
     * @return mixed
     */
    public function getAssessments()
    {
        return $this->assessments;
    }

    /**
     * @param mixed $assessments
     */
    public function setAssessments($assessments): void
    {
        $this->assessments = $assessments;
    }


    /**
     * @return mixed
     */
    public function getInstructorName()
    {
        return $this->instructorName;
    }

    /**
     * @param mixed $instructor_name
     */
    public function setInstructorName($instructor_name): void
    {
        $this->instructorName = $instructor_name;
    }

    /**
     * @return mixed
     */
    public function getCrn()
    {
        return $this->crn;
    }

    /**
     * @param mixed $crn
     */
    public function setCrn($crn): void
    {
        $this->crn = $crn;
    }

    /**
     * @return mixed
     */
    public function getCourseName()
    {
        return $this->courseName;
    }

    /**
     * @param mixed $course_name
     */
    public function setCourseName($course_name): void
    {
        $this->courseName = $course_name;
    }

    /**
     * @return mixed
     */
    public function getCourseNumber()
    {
        return $this->courseNumber;
    }

    /**
     * @param mixed $course_number
     */
    public function setCourseNumber($course_number): void
    {
        $this->courseNumber = $course_number;
    }

    /**
     * @return mixed
     */
    public function getCourseSection()
    {
        return $this->courseSection;
    }

    /**
     * @param mixed $course_section
     */
    public function setCourseSection($course_section): void
    {
        $this->courseSection = $course_section;
    }

    /**
     * @return mixed
     */
    public function getStudentContact()
    {
        return $this->studentContact;
    }

    /**
     * @param mixed $student_contact
     */
    public function setStudentContact($student_contact): void
    {
        $this->studentContact = $student_contact;
    }

    /**
     * @return mixed
     */
    public function getClassTimes()
    {
        return $this->classTimes;
    }

    /**
     * @param mixed $class_times
     */
    public function setClassTimes($class_times): void
    {
        $this->classTimes = $class_times;
    }

    /**
     * @return mixed
     */
    public function getClassParticipation()
    {
        return $this->classParticipation;
    }

    /**
     * @param mixed $class_participation
     */
    public function setClassParticipation($class_participation): void
    {
        $this->classParticipation = $class_participation;
    }

    /**
     * @return mixed
     */
    public function getRecommendedText()
    {
        return $this->recommendedText;
    }

    /**
     * @param mixed $recommendedText
     */
    public function setRecommendedText($recommendedText): void
    {
        $this->recommendedText = $recommendedText;
    }

    /**
     * @return mixed
     */
    public function getRecommendedTextLocation()
    {
        return $this->recommendedTextLocation;
    }

    /**
     * @param mixed $recommended_text_location
     */
    public function setRecommendedTextLocation($recommended_text_location): void
    {
        $this->recommendedTextLocation = $recommended_text_location;
    }



}