<?php
namespace services;

require_once 'config/config.php';


use core\Application;



class AdminLoginService {
    

    public function execute($userName,$password) {
        try {
        
        
        if($userName=="mk" && $password=="1386"){
            $jwtManagerService=new JwtManagerService();
            $token=$jwtManagerService->sign([
                "user_name"=>"mk",
                "password"=>"1386"
            ],Application::$app->jwt_secret);
            return [
            "isSuccess"=>true,
            "token"=>$token,
        ];
        }

          return [
            "isSuccess"=>false,            
        ];
        
    
        } catch (Exception  $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

   

}