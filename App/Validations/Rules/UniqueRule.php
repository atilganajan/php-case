<?php

namespace App\Validations\Rules;

use PDO;
use Rakit\Validation\Rule;

class UniqueRule extends Rule
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fillParameters(array $params): Rule
    {
        $this->params['table'] = $params[0];
        $this->params['column'] = $params[1];
        $this->params['exclude_id'] = $params[2] ?? null;
        return $this;
    }

    public function check($value): bool
    {
        $column = $this->parameter('column');
        $table = $this->parameter('table');
        $excludeId = $this->parameter('exclude_id');

        $query = "SELECT COUNT(*) FROM $table WHERE $column = :value";
        if ($excludeId !== null) {
            $query .= " AND id != :exclude_id";
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        if ($excludeId !== null) {
            $stmt->bindParam(':exclude_id', $excludeId, PDO::PARAM_INT);
        }

        $stmt->execute();

        $count = $stmt->fetchColumn();

        return $count === 0;
    }
}
