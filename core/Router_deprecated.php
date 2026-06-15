<?php
namespace core;

class Router {
    protected $routes = [];
    protected $request;

      public function __construct(Request $request) {
        $this->request = $request;
    }

    public function add($method, $path, $handler) {
        $path = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $path);
        $this->routes[] = [
            'method' => $method,
            'pattern' => "#^$path$#",
            'handler' => $handler
        ];
    }
    
    public function get($path, $handler) {
        $this->add('GET', $path, $handler);
    }
    
    public function post($path, $handler) {
        $this->add('POST', $path, $handler);
    }
    
    public function resolve() {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        
        //print_r($this->routes);
        
        foreach ($this->routes as $route) {            
            if ($route['method'] === $method && preg_match($route['pattern'], $path, $matches)) {


               // استخراج فقط کلیدهای رشته‌ای (پارامترهای نام‌دار)
            $params = array_filter($matches, function($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);

                return $this->callHandler($route['handler'], $params);
            }
        }
        
        http_response_code(404);
        return "404 - Page not found";
    }
    
    protected function callHandler($handler, $params) {        
        if (is_callable($handler)) {
            return call_user_func($handler, $params);
        }
        
        if (is_array($handler)) {            
            $controller = new $handler[0];
            $method = $handler[1];
            

            return call_user_func_array([$controller, $method],$params);
        }
        
        return $handler;
    }
}