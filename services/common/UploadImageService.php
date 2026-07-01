<?php
namespace services;

use core\Application;

class UploadImageService {
    
    

   
    public function execute()
    {

    $fields=Application::$app->request->post();
    $file=Application::$app->request->file("myfile");

    $directory = $fields['directory'] ?? '';


if (isset($file) && $file['error'] === 0) {

    $uploadDir = "images/";    

    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($file['name']);
    $destination = $uploadDir . $fileName;
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return true;
    } else {
        return false;
    }

   


    }




    


}

}