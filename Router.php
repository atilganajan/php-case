<?php

class Router {
    private $routes = [];

    // TODO Start Definitions of HTTP request methods
    public function get($path, $action) {
        $this->routes['GET'][$path] = $action;
    }

    public function post($path, $action) {
        $this->routes['POST'][$path] = $action;
    }

    public function put($path, $action) {
        $this->routes['PUT'][$path] = $action;
    }

    public function delete($path, $action) {
        $this->routes['DELETE'][$path] = $action;
    }
    // TODO End Definitions of HTTP request methods

    // TODO Start Call Controllers
    public function route($request) {

        session_start();

        $this->generateCSRFToken();

        $method = $_SERVER['REQUEST_METHOD'];
        if (array_key_exists($method, $this->routes) && array_key_exists($request, $this->routes[$method])) {
            $this->callAction($this->routes[$method][$request]);
        } else {
            $this->notFound();
        }
    }

    private function callAction($action) {
        $classPath = str_replace('\\', '/', $action[0]);
        $classPath = ltrim($classPath, '/');
        $filePath =  $classPath . '.php';

        require_once $filePath;

        $controllerInstance = new $action[0]();
        $controllerInstance->{$action[1]}();
    }
    // TODO End Call Controllers

    private function notFound() {
        http_response_code(404);
        require_once 'views/404.php';
    }

    private function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

}