<?php

namespace App\controllers;

use App\Validations\Student\StudentValidation;
use Database;

class StudentGradeController
{

    public function index()
    {
        require_once 'views/student_grade.php';
    }

    public function studentStore()
    {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $student_number = $_POST['student_number'];

        $database = new Database();
        $pdo = $database->getConnection();

        $validation = new StudentValidation($pdo);
        $validationResult = $validation->createStudent($name, $surname, $student_number);

        if($validationResult){
            echo json_encode(['error' => $validationResult]);
            return;
        }
        $stmt = $pdo->prepare("INSERT INTO students (name, surname, student_number) VALUES (:name, :surname, :student_number)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':student_number', $student_number);

        $stmt->execute();

        echo "success";
    }

}