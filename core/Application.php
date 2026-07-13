<?php
namespace core;

require_once 'Request.php';
require_once 'Router.php';
require_once 'Database.php';
require_once 'Tools.php';

class Application {
    public static $app;
    public $router;
    public $request;
    public $db;
    public $jwt_secret;
    public $root_route;
    public $tools;
    public function __construct($config) {
        self::$app = $this;
        $this->request = new Request();  // اضافه شد
        $this->router = new Router($this->request); // ارسال request به router
        $this->db = new Database($config['db']);
        $this->jwt_secret = $config['jwt_secret'];
        $this->root_route = $config['root_route'];
        $this->tools=new Tools();
        
    }
    
    public function run() {
        echo $this->router->resolve();
    }
}