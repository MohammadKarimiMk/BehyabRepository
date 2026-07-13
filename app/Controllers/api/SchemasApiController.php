<?php
namespace app\Controllers;

require_once 'core/Controller.php';
require_once 'services/schema/GetSchemasListService.php';


use services\GetSchemasListService;

use core\Controller;


class SchemasApiController extends Controller {
    public function get_schemas($page) {         
    $getSchemasListService=new GetSchemasListService();
    $schemas= $getSchemasListService->execute($page);
    
    

    
$clonedSchemasData=$schemas["data"];
$schemas["data"]=[];

$schemas["html"]="";
 foreach ($clonedSchemasData as $key => $value) {
         $schemas["html"].=\core\View::renderComponent('schema_card', [
     'detail' => $value,
 ])."\n";
     }

    $this->json_response($schemas,200);
    }    

    public function get_schemas_by_category($page,$category_id) {         
    $getSchemasListService=new GetSchemasListService();
    $schemas= $getSchemasListService->execute($page,$category_id);
    
    //$test=[];
    //$this->json_response($schemas,200);
    //$this->json_response($test,200);


$clonedSchemasData=$schemas["data"];
$schemas["data"]=[];

$schemas["html"]="";
 foreach ($clonedSchemasData as $key => $value) {
         $schemas["html"].=\core\View::renderComponent('schema_card', [
     'detail' => $value,
 ])."\n";
     }

    $this->json_response($schemas,200);


    }    
    public function search_schemas($page,$search_key) {         
    $getSchemasListService=new GetSchemasListService();
    $schemas= $getSchemasListService->execute($page,searchKey:$search_key);
    


    $clonedSchemasData=$schemas["data"];
$schemas["data"]=[];

$schemas["html"]="";
 foreach ($clonedSchemasData as $key => $value) {
         $schemas["html"].=\core\View::renderComponent('schema_card', [
     'detail' => $value,
 ])."\n";
     }
    $this->json_response($schemas,200);
    }    
}