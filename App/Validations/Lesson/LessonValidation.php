<?php

namespace App\Validations\Lesson;
use App\Validations\Rules\UniqueRule;
use Rakit\Validation\Validator;
use Database;
class LessonValidation
{
    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }
    public function createLesson($name)
    {
        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule($this->pdo));

        $validation = $validator->make([
            'name' => $name,
        ], [
            'name' => 'required|max:100|unique:lessons,name',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->all();
        }

    }

    public function updateLesson($name, $id){
        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule($this->pdo));

        $validation = $validator->make([
            'name' => $name,
        ], [
            'name' => 'required|max:100|unique:lessons,name,'.$id,
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors();
            return $errors->all();
        }
    }

}
