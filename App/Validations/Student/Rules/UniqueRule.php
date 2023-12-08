<?php

namespace App\Validations\Student\Rules;

use Rakit\Validation\Rule;
use PDO;

class UniqueRule extends Rule
{
    protected $message = ':attribute :value has already been taken';

    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fillParameters(array $params): Rule
    {
        $this->params['table'] = $params[0];
        $this->params['column'] = $params[1];
        return $this;
    }

    public function check($value): bool
    {
        $column = $this->parameter('column');
        $table = $this->parameter('table');

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $table WHERE $column = :value");
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        return $count === 0;
    }
}
