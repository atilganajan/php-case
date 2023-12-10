<?php

namespace App\Validations\Grade;
use Rakit\Validation\Validator;
use Database;
class GradeValidation
{
    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }
    public function createGrade($student_id,$lesson_id,$grade)
    {
        $validator = new Validator;

        $validation = $validator->make([
            'student' => $student_id,
            'lesson' => $lesson_id,
            'grade' => $grade,
        ], [
            'student' => 'required',
            'lesson' => 'required',
            'grade' => 'required|numeric|between:0,100',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->all();
        }

    }

    public function updateGrade($student_id,$lesson_id,$grade){
        $validator = new Validator;


        $validation = $validator->make([
            'student' => $student_id,
            'lesson' => $lesson_id,
            'grade' => $grade,
        ], [
            'student' => 'required',
            'lesson' => 'required',
            'grade' => 'required|numeric|between:0,100',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->all();
        }
    }

}
