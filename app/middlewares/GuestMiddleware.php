<?php

namespace app\middlewares;

require_once 'core/Middleware.php';


use core\Middleware;
use core\Request;

class GuestMiddleware extends Middleware
{
    public function handle(Request $request, callable $next)
    {
        
        // اگر کاربر لاگین است، به صفحه اصلی هدایت شو
        if (isset($_SESSION['user_id'])) {
            $this->redirect("/behyab");
        }

        $_SESSION['user_id']="salam";        
        return $next($request);
    }
}