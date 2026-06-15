<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/common/UploadImageService.php';
require_once 'services/common/UploadDatabaseService.php';
require_once 'services/common/MapSqliteToMysqlService.php';


use services\UploadImageService;
use services\UploadDatabaseService;
use services\MapSqliteToMysqlService;

use core\Controller;

use core\Application;


class BaseDataApiController extends Controller {
    public function upload_image() {         

    
    $uploadImageService=new UploadImageService();
    $isSuccess=$uploadImageService->execute();
    $this->json_response(["isSuccess"=>$isSuccess],200);

    
    }    

    public function upload_database() {         

    
    $uploadImageService=new UploadDatabaseService();
    $isSuccess=$uploadImageService->execute();
    if($isSuccess==true){
     $mapSqliteToMysqlService=new MapSqliteToMysqlService();
     $mapSqliteToMysqlService->execute();
    }
    $this->json_response(["isSuccess"=>$isSuccess],200);

    
    }    
}