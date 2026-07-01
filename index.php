<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


session_start(); // شروع سشن برای احراز هویت


//core
require_once 'core/ViewComposer.php';
require_once 'core/Application.php';
//core


//config
require_once 'config/config.php';
//config

//controller
require_once 'app/Controllers/HomeController.php';
require_once 'app/Controllers/CategoriesController.php';
require_once 'app/Controllers/TestController.php';
require_once 'app/Controllers/api/TestApiController.php';
require_once 'app/Controllers/api/SchemasApiController.php';
require_once 'app/Controllers/api/AdminLoginApiController.php';
require_once 'app/Controllers/api/BaseDataApiController.php';
//controller



//services
require_once 'services/categories/GetAllCategoriesService.php';
//services


//middlewares
require_once 'app/middlewares/GuestMiddleware.php';

//middlewares


use core\ViewComposer;
use core\Application;
use services\GetAllCategoriesService;



$app = new Application($config);


ViewComposer::compose('partials.header', function() {
    //$db = Application::$app->db;
    
    // دریافت منوی داینامیک
    //$stmt = $db->query("SELECT * FROM testtb LIMIT 5");
    //$testData = $stmt->fetchAll();
    
    //$testData = [];


    $getAllCategoriesService=new GetAllCategoriesService();
    $res=$getAllCategoriesService->execute();

    
    
    
    return [
        'data'=>$res,
    ];
});



$app->router->get('/', [app\Controllers\HomeController::class, 'index']);
$app->router->get('/product/{id}', [app\Controllers\HomeController::class, 'schema_detail']);
$app->router->get('/categories', [app\Controllers\CategoriesController::class, 'get_categories']);



$app->router->get('/about/{id}/{page}', [app\Controllers\HomeController::class, 'about']);
$app->router->post('/contact', function() {
    return "Form submitted!";
});


$app->router->get('/api/test',[app\Controllers\TestApiController::class, 'test_func']);


$app->router->get('/api/schema/{page}',[app\Controllers\SchemasApiController::class, 'getSchemas']);



$app->router->get('/test',[app\Controllers\TestController::class, 'index'],[app\middlewares\GuestMiddleware::class]);



$app->router->post('/api/admin/login',[app\Controllers\AdminLoginApiController::class, 'login_admin']);

$app->router->post('/api/admin/upload_image',[app\Controllers\BaseDataApiController::class, 'upload_image']);
$app->router->post('/api/admin/upload_database',[app\Controllers\BaseDataApiController::class, 'upload_database']);



$app->run();