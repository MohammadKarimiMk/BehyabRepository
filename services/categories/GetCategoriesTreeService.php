<?php
namespace services;

use core\Application;

use PDO;

class GetCategoriesTreeService {
    
    
    public function execute($category_id) {
        try {
        $db = Application::$app->db;

        $sql="WITH RECURSIVE category_tree AS (
    -- بخش پایه: خود دسته‌بندی مورد نظر
    SELECT 
        Id,
        Name,
        ParentId,
        0 AS level,
        CAST(id AS CHAR(1000)) AS path
    FROM categories
    WHERE Id = :categoryId
    
    UNION ALL
    
    
    SELECT 
        c.Id,
        c.Name,
        c.ParentId,
        ct.level + 1,
        CONCAT(ct.path, ' -> ', c.Id)
    FROM categories c
    INNER JOIN category_tree ct ON c.Id = ct.ParentId
)
SELECT 
    Id,
    Name,
    ParentId,
    level,
    path
FROM category_tree
ORDER BY level ASC;";

        
        $items= $db->query($sql,["categoryId"=>$category_id])->fetchAll();

        $result=array_reverse($items);

        

    return $result;
    //print_r(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        } catch (Exception  $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

   

}