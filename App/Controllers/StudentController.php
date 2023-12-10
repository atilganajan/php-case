<?php

namespace App\Controllers;
use App\Models\StudentModel;
use App\Validations\Student\StudentValidation;
class StudentController{

    public function getStudents()
    {
        try {
            header('Content-Type: application/json');
            $studentModel = new StudentModel();

            $students = $studentModel->getStudents();

            echo json_encode(['status' => true, "students" => $students]);

        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            http_response_code(500);
            echo json_encode(['status' => false]);
        }
    }

    public function studentStore()
    {
        try {
            header('Content-Type: application/json');
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $student_number = trim($_POST['student_number']);

            $validation = new StudentValidation();
            $validationResult = $validation->createStudent($name, $surname, $student_number);

            if ($validationResult) {
                http_response_code(422);
                echo json_encode(['status' => false, 'errors' => $validationResult]);
                return;
            }

            $studentModel = new StudentModel();

            $result = $studentModel->setStudent($name, $surname, $student_number);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Student created successfully"]]);
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'errors' => $result['error']]);
            }

        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            http_response_code(500);
            echo json_encode(['status' => false, 'errors' => ["Unexpected server error. Please try again later"]]);
        }

    }

    public function studentUpdate()
    {
        try {
            header('Content-Type: application/json');
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $student_number = trim($_POST['student_number']);
            $id = $_POST['student_id'];

            $validation = new StudentValidation();
            $validationResult = $validation->updateStudent($name, $surname, $student_number, $id);

            if ($validationResult) {
                http_response_code(422);
                echo json_encode(['status' => false, 'errors' => $validationResult]);
                return;
            }

            $studentModel = new StudentModel();

            $result = $studentModel->updateStudent($name, $surname, $student_number, $id);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Student updated successfully"]]);
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'errors' => $result['error']]);
            }

        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            http_response_code(500);
            echo json_encode(['status' => false, 'errors' => ["Unexpected server error. Please try again later"]]);
        }

    }

    public function studentDelete(){
        try {
            header('Content-Type: application/json');

            $id = $_POST['id'];

            $studentModel = new StudentModel();

            $result = $studentModel->deleteStudent($id);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Student deleted successfully"]]);
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'errors' => $result['error']]);
            }

        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            http_response_code(500);
            echo json_encode(['status' => false, 'errors' => ["Unexpected server error. Please try again later"]]);
        }
    }

}