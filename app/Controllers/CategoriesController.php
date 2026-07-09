<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/categories/GetAllCategoriesService.php';

require_once 'services/schema/GetSchemasListService.php';

//config
require_once 'config/config.php';
//config


use core\Controller;
use core\Application;


use services\GetAllCategoriesService;

use services\GetSchemasListService;


class CategoriesController extends Controller {
    public function get_categories() {         
        $user_agent=Application::$app->request->header('HTTP_USER_AGENT');
        if(str_contains($user_agent,'Mobile')==false){
            $this->redirect(Application::$app->root_route);   
        }
        $getAllCategoriesService=new GetAllCategoriesService();
        $categories= $getAllCategoriesService->execute();
          $data = [
            'categories'=>$categories["categories"],
        ];
        
        // رندر کردن view درون layout پیش‌فرض (main)
        $this->view('categories', $data);
    }

        public function get_schemas_by_category($id) {         

     
        $getSchemasListService=new GetSchemasListService();
        $schemas= $getSchemasListService->execute(1,$id);

          $data = [
            'category_id'=>$id,
            'schemas'=>$schemas["data"],
        ];
        
        // رندر کردن view درون layout پیش‌فرض (main)
        $this->view('category', $data);
        
        }
    
    public function about($id,$page) {        
       $data = ['page' => $page];
        // رندر کردن با layout دیگری به نام 'simple'
        $this->view('about', $data); 
        
    }
}