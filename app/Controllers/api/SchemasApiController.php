<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/schema/GetSchemasListService.php';


use services\GetSchemasListService;

use core\Controller;


class SchemasApiController extends Controller {
    public function get_schemas($page) {         
        echo 'salam';
    $getSchemasListService=new GetSchemasListService();
    $schemas= $getSchemasListService->execute($page);
    
    $this->json_response($schemas,200);
    }    

    public function get_schemas_by_category($page,$category_id) {         
    echo 'salam cat';
    $getSchemasListService=new GetSchemasListService();
    $schemas= $getSchemasListService->execute($page,$category_id);
    
    $this->json_response($schemas,200);
    }    
}