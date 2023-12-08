<?php

use App\controllers\StudentGradeController;

require_once('config/Database.php');
require_once('Router.php');
require_once('App/Controllers/StudentGradeController.php');

$router = new Router();


$router->get('/', [StudentGradeController::class,"index"]);

$router->post('/student/store', [StudentGradeController::class,"studentStore"],["CSRFMiddleware"]);

$request = $_SERVER['REQUEST_URI'];

$router->route($request);
