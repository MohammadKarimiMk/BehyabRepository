<?php
namespace app\Controllers;

require_once 'core/Controller.php';

use core\Controller;


class TestApiController extends Controller {
    public function test_func() {         
    $data = [
            'region'=>'iran'
        ];
        $this->json_response($data,200);
    }    
}