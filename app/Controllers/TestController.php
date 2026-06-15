<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/schema/GetSchemasListService.php';

use core\Controller;

use services\GetSchemasListService;

class TestController extends Controller {
    public function index() {         
  
        // رندر کردن view درون layout پیش‌فرض (main)
        $this->view('test');
    }
    
    public function about($id,$page) {        
       $data = ['page' => $page];
        // رندر کردن با layout دیگری به نام 'simple'
        $this->view('about', $data); 
        
    }
}