<?php
namespace App\Middlewares;

class CSRFMiddleware {
    public function handle() {
        $headers = getallheaders();
        $csrfToken = $headers['X-CSRF-TOKEN'];
        if (!isset($csrfToken) || $csrfToken !== $_SESSION['csrf_token']) {
            http_response_code(403);
            die("CSRF token validation failed");
        }
    }
}
