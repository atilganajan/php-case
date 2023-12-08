<?php

require_once('config/Database.php');

$tables = [
    'CREATE TABLE students( 
        id   INT AUTO_INCREMENT PRIMARY KEY,
        student_number BIGINT UNSIGNED NOT NULL UNIQUE,
        name  VARCHAR(100) NOT NULL, 
        surname VARCHAR(100) NOT NULL
    );',
    'CREATE TABLE lessons (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL UNIQUE
    );',
    'CREATE TABLE grades (
       id INT AUTO_INCREMENT PRIMARY KEY,
       student_id INT NOT NULL,
       lesson_id INT NOT NULL,
       grade DECIMAL(4,2) NOT NULL,
       CONSTRAINT check_grade_range CHECK (grade >= 0 AND grade <= 100),
       FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
       FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE
    );'];

$pdo = (new Database())->getConnection();

foreach ($tables as $table) {
    $pdo->exec($table);
}