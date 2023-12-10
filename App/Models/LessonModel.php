<?php

namespace App\Models;
use Database;
use PDO;
class LessonModel{
    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }
    public function getLessons(){
        try {
            $pdo = $this->pdo;
            $query = $pdo->prepare("SELECT * FROM lessons ORDER BY id desc ");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function setLesson($name){
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("INSERT INTO lessons (name) VALUES (:name)");
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            return ['status' => true];
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function updateLesson($name,$id){
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("UPDATE lessons SET name = :name WHERE id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return ['status' => true];
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }

    public function deleteLesson($id){
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("DELETE FROM lessons WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return ['status' => true];
        }catch (\Exception $e){
            error_log("[" . date('Y-m-d H:i:s') . "] File: " . __FILE__ . ", Line: " . __LINE__. ", Error: ".$e->getMessage() , 3, "logFile.log");
            return ['status' => false, 'error' => ["Unexpected server error. Please try again later"]];

        }
    }



}