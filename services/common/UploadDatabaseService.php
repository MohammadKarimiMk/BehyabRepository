<?php
namespace services;

use core\Application;

class UploadDatabaseService {
    
    

   
    public function execute()
    {

    $file=Application::$app->request->file("myfile");



if (isset($file) && $file['error'] === 0) {

    $this->deleteFolderRecursively("images/");    

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



private function deleteFolderRecursively($dir) {
    if (!is_dir($dir)) {
        return false;
    }
    
    // Get all items in the directory
    $items = scandir($dir);
    
    foreach ($items as $item) {
        // Skip . and ..
        if ($item === '.' || $item === '..') {
            continue;
        }
        
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        
        if (is_dir($path)) {
            // Recursively delete subdirectory
            $this->deleteFolderRecursively($path);
        } else {
            // Delete file
            unlink($path);
        }
    }
    
    // Now the directory is empty, delete it
    return rmdir($dir);
}


}