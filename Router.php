<?php

class Router {
    private $routes = [];

    public function get($path, $action, $middlewares) {
        $this->routes['GET'][$path] = $action;
        $this->routes['GET'][$path]["middlewares"] = $middlewares;
    }

    public function post($path, $action, $middlewares) {
        $this->routes['POST'][$path] = $action;
        $this->routes['POST'][$path]["middlewares"] = $middlewares;
    }

/*    public function put($path, $action, $middlewares) {

        $this->routes['PUT'][$path] = $action;
       $this->routes['PUT'][$path]["middlewares"] = [];
    }

    public function delete($path, $action, $middlewares) {
        $this->routes['DELETE'][$path] = $action;
        $this->routes['DELETE'][$path]["middlewares"] = $middlewares;
    }*/

    public function route($request) {
        session_start();

        $this->generateCSRFToken();

        $method = $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($method, $this->routes) && array_key_exists($request, $this->routes[$method])) {
            $this->applyMiddlewares( $this->routes[$method][$request]["middlewares"]);
            $this->callAction($this->routes[$method][$request]);
        } else {
            $this->notFound();
        }
    }


    private function applyMiddlewares($middlewares) {

        foreach ($middlewares as $middleware) {
            $middlewareInstance = new $middleware();
            $middlewareInstance->handle();
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