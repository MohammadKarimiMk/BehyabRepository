<?php
namespace app\middlewares;

use core\Middleware;
use core\Request;

class AuthMiddleware extends Middleware
{
    public function handle(Request $request, callable $next)
    {
        // بررسی وجود session برای کاربر لاگین شده
        if (!isset($_SESSION['user_id'])) {
            $this->redirectToLogin();
        }
        
        // ادامه به middleware بعدی یا کنترلر
        return $next($request);
    }
}