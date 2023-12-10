<?php

namespace App\Models;

use Database;
use PDO;

class GradeModel
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getGrades()
    {
        try {
            $pdo = $this->pdo;
            $query = $pdo->prepare("SELECT grades.*, CONCAT(students.name, ' ', students.surname) as student_full_name, lessons.name as lesson_name FROM grades 
            INNER JOIN students ON grades.student_id = students.id
            INNER JOIN lessons ON grades.lesson_id = lessons.id                                                                
            ORDER BY grades.id DESC");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function setGrade($student_id, $lesson_id, $grade)
    {
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("INSERT INTO grades (student_id,lesson_id,grade) VALUES (:student_id, :lesson_id, :grade)");
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':lesson_id', $lesson_id);
            $stmt->bindParam(':grade', $grade);
            $stmt->execute();

            return ['status' => true];
        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function updateGrade($student_id, $lesson_id, $grade, $id)
    {
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("UPDATE grades SET student_id = :student_id, lesson_id = :lesson_id, grade = :grade WHERE id = :id");
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':lesson_id', $lesson_id);
            $stmt->bindParam(':grade', $grade);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return ['status' => true];
        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function deleteGrade($id)
    {
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("DELETE FROM grades WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return ['status' => true];
        } catch (\Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }
}