<?php

namespace App\Middlewares;

class CSRFMiddleware {
    public function handle() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            die("CSRF token validation failed");
        }
    }
}
