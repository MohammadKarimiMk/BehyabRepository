<?php
namespace services;

use core\Application;

class UploadDatabaseService {
    
    

   
    public function execute()
    {

    $file=Application::$app->request->file("myfile");



if (isset($file) && $file['error'] === 0) {

    $uploadDir = "databases/";


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