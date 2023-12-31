<?php

namespace App\Validations\Student;
use App\Validations\Rules\UniqueRule;
use Database;
use Rakit\Validation\Validator;

class StudentValidation
{
    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }
    public function createStudent($name, $surname, $student_number)
    {

        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule($this->pdo));

        $validation = $validator->make([
            'name' => $name,
            'surname' => $surname,
            'student_number' => $student_number,
        ], [
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'student_number' => 'required|max:10|unique:students,student_number',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->all();
        }

    }

    public function updateStudent($name, $surname, $student_number, $id)
    {

        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule($this->pdo));

        $validation = $validator->make([
            'name' => $name,
            'surname' => $surname,
            'student_number' => $student_number,
        ], [
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'student_number' => 'required|max:10|unique:students,student_number,'.$id,
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->all();
        }

    }
}
