<?php

namespace App\controllers;

class StudentGradeController
{
    public function index()
    {
        require_once 'views/student_grade.php';
    }

    public function studentStore()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("CSRF token validation failed");
        }
    }

}