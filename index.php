<?php
require_once 'vendor/autoload.php';
require_once('config/Database.php');
require_once('Router.php');

use App\Controllers\IndexController;
use App\Controllers\StudentController;
use App\Controllers\LessonController;
use App\Controllers\GradeController;
use App\Middlewares\CSRFMiddleware;

error_reporting(E_ERROR | E_PARSE);

$router = new Router();

$router->get('/', [IndexController::class,"index"],[]);

$router->get('/student', [StudentController::class,"getStudents"],[]);
$router->post('/student/store', [StudentController::class,"studentStore"],[CSRFMiddleware::class]);
$router->post('/student/update', [StudentController::class,"studentUpdate"],[CSRFMiddleware::class]);
$router->post('/student/delete', [StudentController::class,"studentDelete"],[CSRFMiddleware::class]);

$router->get('/lesson', [LessonController::class,"getLessons"],[]);
$router->post('/lesson/store', [LessonController::class,"lessonStore"],[CSRFMiddleware::class]);
$router->post('/lesson/update', [LessonController::class,"lessonUpdate"],[CSRFMiddleware::class]);
$router->post('/lesson/delete', [LessonController::class,"lessonDelete"],[CSRFMiddleware::class]);

$router->get('/grade', [GradeController::class,"getGrades"],[]);
$router->post('/grade/store', [GradeController::class,"gradeStore"],[CSRFMiddleware::class]);
$router->post('/grade/update', [GradeController::class,"gradeUpdate"],[CSRFMiddleware::class]);
$router->post('/grade/delete', [GradeController::class,"gradeDelete"],[CSRFMiddleware::class]);

$request = $_SERVER['REQUEST_URI'];

$router->route($request);
