<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/schema/GetSchemasListService.php';
require_once 'services/common/JwtManagerService.php';

use core\Controller;

use services\GetSchemasListService;
use services\JwtManagerService;

class HomeController extends Controller {
    public function index() {         
  
        // $jwtManagerService=new JwtManagerService();
        // $token= $jwtManagerService->sign(["name"=>"mk"],"iran");
        // echo $token;
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // print_r($jwtManagerService->verify($token,"iran"));


        
        $getSchemasListService=new GetSchemasListService();
        $schemas= $getSchemasListService->execute(1);

          $data = [
            'title' => 'صفحه اصلی',
            'message' => 'به فریم‌ورک ما خوش آمدید!',
            'schemas'=>$schemas["data"],
        ];
        
        // رندر کردن view درون layout پیش‌فرض (main)
        $this->view('home', $data);
    }
    
    public function schema_detail() {        
        $data = [];        
        $this->view('schema_detail', $data); 
        
    }
}