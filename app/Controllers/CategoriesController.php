<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/categories/GetAllCategoriesService.php';

use core\Controller;
use core\Application;


use services\GetAllCategoriesService;


class CategoriesController extends Controller {
    public function get_categories() {         
        $user_agent=Application::$app->request->header('HTTP_USER_AGENT');
        if(str_contains($user_agent,'Mobile')==false){
            $this->redirect('/behyab');   
        }
        $getAllCategoriesService=new GetAllCategoriesService();
        $categories= $getAllCategoriesService->execute();
          $data = [
            'title' => 'صفحه اصلی',
            'message' => 'به فریم‌ورک ما خوش آمدید!',
            'categories'=>$categories["categories"],
        ];
        
        // رندر کردن view درون layout پیش‌فرض (main)
        $this->view('categories', $data);
    }
    
    public function about($id,$page) {        
       $data = ['page' => $page];
        // رندر کردن با layout دیگری به نام 'simple'
        $this->view('about', $data); 
        
    }
}