<?php

namespace App\Models;
use Database;
use PDO;
class StudentModel{
    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getStudents(){
        try {
            $pdo = $this->pdo;
            $query = $pdo->prepare("SELECT *, CONCAT(name,' ',surname) as full_name, FORMAT((SELECT AVG(grades.grade) FROM grades WHERE grades.student_id = students.id ),2) as grade_average FROM students ORDER BY id desc ");

            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function setStudent($name,$surname,$student_number){
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("INSERT INTO students (name, surname, student_number) VALUES (:name, :surname, :student_number)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':student_number', $student_number);
            $stmt->execute();

            return ['status' => true];
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function updateStudent($name,$surname,$student_number,$id){
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("UPDATE students SET name = :name, surname = :surname, student_number = :student_number WHERE id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':student_number', $student_number);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return ['status' => true];
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function deleteStudent($id){
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return ['status' => true];
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }




}