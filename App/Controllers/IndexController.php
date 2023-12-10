<?php

namespace App\Controllers;

use App\Models\LessonModel;
use App\Models\StudentModel;

class IndexController{
    public function index()
    {
        $lessons = new LessonModel();
        $lessons = $lessons->getLessons();

        $students = new StudentModel();
        $students = $students->getStudents();

        require_once 'views/student_grade.php';
    }

}