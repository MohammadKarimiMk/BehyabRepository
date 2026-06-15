<?php
namespace services;

use core\Application;

use PDO;

class GetAllCategoriesService {
    
    
    public function execute() {
        try {
        $db = Application::$app->db;

        $sql="SELECT * FROM Categories";

        
        $items= $db->query($sql)->fetchAll();

        $result=[];

        $mainCategories = array_filter($items, function($item) {
    return $item["ParentId"]  === null;
});


    //$result["main_categories"]=$mainCategories;
    foreach ($mainCategories as $mainCategory) {
        $sub1Categories=array_filter($items, function($child) use ($mainCategory) {
    return $child["ParentId"]  == $mainCategory["Id"];
});

  $sub1CategoriesChilds=[];
  foreach ($sub1Categories as $sub1Category) {
     $sub2Categories=array_filter($items, function($child) use ($sub1Category) {
    return $child["ParentId"]  == $sub1Category["Id"];
});
$sub2CategoriesChilds=[];
  foreach ($sub2Categories as $sub2Category) {
     $sub2CategoriesChilds[]=[
        "id"=>$sub2Category["Id"],
        "name"=>$sub2Category["Name"],
    ];
  }
    $sub1CategoriesChilds[]=[
        "id"=>$sub1Category["Id"],
        "name"=>$sub1Category["Name"],
        "categories"=>$sub2CategoriesChilds,
    ];
        }

        $result["categories"][]=[
            "id"=>$mainCategory["Id"],
            "name"=>$mainCategory["Name"],
            "categories"=>$sub1CategoriesChilds,
        ];

      

    }

    return $result;
    //print_r(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        } catch (Exception  $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

   

}