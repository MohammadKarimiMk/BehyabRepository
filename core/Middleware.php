<?php
namespace core;

abstract class Middleware
{
    /**
     * پردازش درخواست
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    abstract public function handle(Request $request, callable $next);
    
    /**
     * پاسخ خطا برای دسترسی غیرمجاز
     */
    protected function unauthorized($message = 'دسترسی غیرمجاز')
    {
        http_response_code(403);
        die($message);
    }
    
    /**
     * ریدایرکت به صفحه لاگین
     */
    protected function redirectToLogin()
    {
        header('Location: /login');
        exit();
    }
    
    protected function redirect($address)
    {
        header('Location: '.$address);
        exit();
    }
}