<?php

namespace App\Controllers;
use App\Models\LessonModel;
use App\Validations\Lesson\LessonValidation;
class LessonController{
    public function getLessons(){
        try {
            header('Content-Type: application/json');
            $lessonModel = new LessonModel();

            $lessons = $lessonModel->getLessons();

            echo json_encode(['status' => true, "lessons" => $lessons]);

        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            http_response_code(500);
            echo json_encode(['status' => false]);
        }
    }

    public function lessonStore()
    {
        try {
            header('Content-Type: application/json');
            $name = trim($_POST['name']);

            $validation = new LessonValidation();
            $validationResult = $validation->createLesson($name);

            if ($validationResult) {
                http_response_code(422);
                echo json_encode(['status' => false, 'errors' => $validationResult]);
                return;
            }

            $studentModel = new LessonModel();

            $result = $studentModel->setLesson($name);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Lesson created successfully"]]);
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

    public function lessonUpdate()
    {
        try {
            header('Content-Type: application/json');
            $name = trim($_POST['name']);
            $id = $_POST['lesson_id'];

            $validation = new LessonValidation();
            $validationResult = $validation->updateLesson($name, $id);

            if ($validationResult) {
                http_response_code(422);
                echo json_encode(['status' => false, 'errors' => $validationResult]);
                return;
            }

            $lessonModel = new LessonModel();

            $result = $lessonModel->updateLesson($name, $id);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Lesson updated successfully"]]);
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

    public function lessonDelete(){
        try {
            header('Content-Type: application/json');

            $id = $_POST['id'];

            $lessonModel = new LessonModel();

            $result = $lessonModel->deleteLesson($id);

            if ($result['status']) {
                http_response_code(200);
                echo json_encode(['status' => true, "messages" => ["Lesson deleted successfully"]]);
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