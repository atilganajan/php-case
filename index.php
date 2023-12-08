<?php
require_once 'vendor/autoload.php';
require_once('config/Database.php');
require_once('Router.php');

use App\controllers\StudentGradeController;
use App\Middlewares\CSRFMiddleware;



$router = new Router();

$router->get('/', [StudentGradeController::class,"index"],[]);

$router->post('/student/store', [StudentGradeController::class,"studentStore"],[CSRFMiddleware::class]);

$request = $_SERVER['REQUEST_URI'];

$router->route($request);
