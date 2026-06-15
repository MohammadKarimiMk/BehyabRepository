<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/schema/GetSchemasListService.php';


use services\GetSchemasListService;

use core\Controller;


class SchemasApiController extends Controller {
    public function getSchemas($page) {         
        
    $getSchemasListService=new GetSchemasListService();
    $schemas= $getSchemasListService->execute($page);
    
    $this->json_response($schemas,200);
    }    
}