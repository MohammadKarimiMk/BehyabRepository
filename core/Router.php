<?php
namespace core;

class Router {
    protected $routes = [];
    protected $request;
    protected $groupMiddleware = [];
    protected $groupPrefix = '';

      public function __construct(Request $request) {
        $this->request = $request;
    }

       /**
     * گروه‌بندی مسیرها با middleware مشترک
     */
    public function group($attributes, $callback)
    {
        $oldMiddleware = $this->groupMiddleware;
        $oldPrefix = $this->groupPrefix;
        
        if (isset($attributes['middleware'])) {
            $this->groupMiddleware = array_merge($this->groupMiddleware, (array)$attributes['middleware']);
        }
        
        if (isset($attributes['prefix'])) {
            $this->groupPrefix = $attributes['prefix'];
        }
        
        $callback($this);
        
        $this->groupMiddleware = $oldMiddleware;
        $this->groupPrefix = $oldPrefix;
    }

    public function add($method, $path, $handler, $middleware = []) {
       
         // اعمال prefix گروه
        $path = $this->groupPrefix . $path;
        
        // ادغام middleware های گروه با middleware های مسیر
        $allMiddleware = array_merge($this->groupMiddleware, (array)$middleware);
        
        // تبدیل پارامترهای {id} به الگوی regex
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = "#^" . $pattern . "$#";
        
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'originalPath' => $path,
            'handler' => $handler,
            'middleware' => $allMiddleware
        ];

    }
    
    public function get($path, $handler, $middleware = []) {
        $this->add('GET', $path, $handler, $middleware);
    }
    
    public function post($path, $handler, $middleware = []) {
        $this->add('POST', $path, $handler, $middleware);
    }
    
    
    public function put($path, $handler, $middleware = [])
    {
        $this->add('PUT', $path, $handler, $middleware);
    }


    public function delete($path, $handler, $middleware = [])
    {
        $this->add('DELETE', $path, $handler, $middleware);
    }
    

    public function resolve() {

     $method = $this->request->getMethod();
     $path = $this->request->getPath();
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $path, $matches)) {
                // استخراج پارامترها
                $params = array_filter($matches, function($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);
                
                $params = array_values($params);
                
                // اجرای middleware ها
                $handler = $route['handler'];
                $middlewareList = $route['middleware'];
                
                // ایجاد زنجیره middleware
                $next = function($request) use ($handler, $params) {
                    return $this->callHandler($handler, $params);
                };
                
                // اجرای middleware ها از آخر به اول
                for ($i = count($middlewareList) - 1; $i >= 0; $i--) {
                    $middlewareClass = $middlewareList[$i];
                    
                    if (!class_exists($middlewareClass)) {
                        die("Middleware not found: {$middlewareClass}");
                    }
                    
                    $middleware = new $middlewareClass();
                    $next = function($request) use ($middleware, $next) {
                        return $middleware->handle($request, $next);
                    };
                }
                
                return $next($this->request);
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