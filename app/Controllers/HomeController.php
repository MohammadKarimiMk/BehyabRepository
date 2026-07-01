<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/schema/GetSchemasListService.php';
require_once 'services/schema/GetSchemaDetailService.php';


use core\Controller;

use services\GetSchemasListService;
use services\GetSchemaDetailService;


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
    
    public function schema_detail($id) {        
        $getSchemasListService=new GetSchemaDetailService();
        $data= $getSchemasListService->execute($id);        
        //$this->json_response($data,200);
        
        if($data["is_success"]==true)
        {
            $this->view('schema_detail', $data["data"]); 
        }
        else {
            $this->view('not_found', $data); 
        }
        
    }
}