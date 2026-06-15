<?php
namespace app\middlewares;

use core\Middleware;
use core\Request;

class LoggingMiddleware extends Middleware
{
    public function handle(Request $request, callable $next)
    {
        $method = $request->getMethod();
        $path = $request->getPath();
        $ip = $request->getIp();
        
        $log = sprintf("[%s] %s %s - IP: %s\n", 
            date('Y-m-d H:i:s'), 
            $method, 
            $path, 
            $ip
        );
        
        file_put_contents(__DIR__ . '/../../storage/logs/access.log', $log, FILE_APPEND);
        
        return $next($request);
    }
}