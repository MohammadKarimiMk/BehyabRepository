<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/login/AdminLoginService.php';


use services\AdminLoginService;

use core\Controller;

use core\Application;


class AdminLoginApiController extends Controller {
    public function login_admin() {         

    $params=Application::$app->request->json();
    $adminLoginService=new AdminLoginService();
    $res= $adminLoginService->execute($params["user_name"],$params["password"]);    
    $this->json_response($res,200);

    
    }    
}