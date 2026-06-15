<?php
namespace app\middlewares;

use core\Middleware;
use core\Request;

class AdminMiddleware extends Middleware
{
    public function handle(Request $request, callable $next)
    {
        // بررسی لاگین بودن
        if (!isset($_SESSION['user_id'])) {
            $this->redirectToLogin();
        }
        
        // بررسی نقش ادمین (فرض کنیم در دیتابیس نقش ذخیره شده)
        if ($_SESSION['role'] !== 'admin') {
            $this->unauthorized('شما دسترسی ادمین ندارید');
        }
        
        return $next($request);
    }
}