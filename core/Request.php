<?php
namespace core;

class Request {
    
    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public function getPath() {
        //$path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = $_SERVER['PATH_INFO'] ?? '/';



        $position = strpos($path, '?');
        
        if ($position === false) {
            return $path;
        }
        
        return substr($path, 0, $position);
    }
    
    public function all() {
        return array_merge($this->get(), $this->post());
    }
    
    public function get() {
        return $_GET;
    }
    
    public function post() {
        $data = [];
        
        if ($this->getMethod() === 'POST') {
            foreach ($_POST as $key => $value) {
                $data[$key] = $this->sanitize($value);
            }
        }
        
        return $data;
    }
    
    public function json() {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }
    
    public function input($key, $default = null) {
        $all = $this->all();
        return $all[$key] ?? $default;
    }
    
    public function has($key) {
        $all = $this->all();
        return isset($all[$key]);
    }
    
    public function files() {
        return $_FILES;
    }
    
    public function file($key) {
        return $_FILES[$key] ?? null;
    }
    
    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
    
    public function isMethod($method) {
        return strtoupper($method) === $this->getMethod();
    }
    
    public function header($key, $default = null) {
        //$key = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        return $_SERVER[$key] ?? $default;
    }
    
    public function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        
        return $ip;
    }
    
    public function getUserAgent() {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
    
    protected function sanitize($data) {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    public function only($keys) {
        $keys = is_array($keys) ? $keys : func_get_args();
        $data = [];
        
        foreach ($keys as $key) {
            if ($this->has($key)) {
                $data[$key] = $this->input($key);
            }
        }
        
        return $data;
    }
    
    public function except($keys) {
        $keys = is_array($keys) ? $keys : func_get_args();
        $data = $this->all();
        
        foreach ($keys as $key) {
            unset($data[$key]);
        }
        
        return $data;
    }
}