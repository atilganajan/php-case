<?php

namespace App\Controllers;

use App\Models\GradeModel;
use App\Validations\Grade\GradeValidation;

class GradeController
{
    public function getGrades()
    {
        try {
            header('Content-Type: application/json');
            $gradeModel = new GradeModel();

            $grades = $gradeModel->getGrades();

            echo json_encode(['status' => true, "grades" => $grades]);

        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            http_response_code(500);
            echo json_encode(['status' => false]);
        }
    }

    public function gradeStore()
    {
        try {
            header('Content-Type: application/json');
            $student_id = $_POST['student_id'];
            $lesson_id = $_POST['lesson_id'];
            $grade = $_POST['grade'];

            $validation = new GradeValidation();
            $validationResult = $validation->createGrade($student_id, $lesson_id, $grade);

            if ($validationResult) {
                http_response_code(422);
                echo json_encode(['status' => false, 'errors' => $validationResult]);
                return;
            }

            $gradeModel = new GradeModel();

            $result = $gradeModel->setGrade($student_id, $lesson_id, $grade);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Grade created successfully"]]);
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

    public function gradeUpdate()
    {
        try {
            header('Content-Type: application/json');
            $student_id = $_POST['student_id'];
            $lesson_id = $_POST['lesson_id'];
            $grade = $_POST['grade'];

            $id = $_POST['grade_id'];

            $validation = new GradeValidation();
            $validationResult = $validation->updateGrade($student_id, $lesson_id, $grade);

            if ($validationResult) {
                http_response_code(422);
                echo json_encode(['status' => false, 'errors' => $validationResult]);
                return;
            }

            $gradeModel = new GradeModel();

            $result = $gradeModel->updateGrade($student_id, $lesson_id, $grade, $id);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Grade updated successfully"]]);
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

    public function gradeDelete()
    {
        try {
            header('Content-Type: application/json');

            $id = $_POST['id'];

            $lessonModel = new GradeModel();

            $result = $lessonModel->deleteGrade($id);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Grade deleted successfully"]]);
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