<?php

$dotenv = [
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'case',
];

foreach ($dotenv as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $value;
}