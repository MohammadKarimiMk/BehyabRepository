<?php
namespace services;

use core\Application;

use PDO;

class GetSchemaDetailService {
    

    

    public function execute($id) {
        try {
        
        $db = Application::$app->db;

              
        //$schemaSql = "SELECT * FROM _schemas WHERE Id= :Id";
        $schemaSql = "SELECT 
    s.*,
    c.Name as category_name
FROM 
    _schemas s
LEFT JOIN 
    categories c ON s.CategoryId = c.Id
WHERE 
    s.id = :Id;";

        
        $productSql = "SELECT Id,WebsiteName,FinalPrice,Link,Name FROM products WHERE SchemaId= :Id";
        $propertiesSql="SELECT _Key,_Value FROM properties WHERE SchemaId= :Id";
        $imagesSql="SELECT Name FROM images WHERE SchemaId= :Id";
        
        
        
        
        $detail=$db->query($schemaSql,["Id"=>$id,])->fetch(PDO::FETCH_ASSOC);
        
        
        
        if($detail==false){
                 $result=[
            "is_success"=>false,           
        ];


        return $result;
        }



        
        //$relatedSchemasSql="SELECT * FROM _schemas WHERE CategoryId = :CategoryId AND Id !=:Id LIMIT 10";
        
        $relatedSchemasSql="SELECT s.Id,
                    s.Name,
                    s.MainImageName,
                    COALESCE(
                        MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END),
                        0
                    ) AS cheapest_price
                FROM _schemas s
                LEFT JOIN products p ON p.SchemaId = s.Id
                WHERE s.CategoryId = :CategoryId AND s.Id !=:Id
                GROUP BY s.Id, s.Name
                ORDER BY 
                    CASE WHEN COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) = 0 
                         THEN 1 ELSE 0 END,
                    COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) ASC
                LIMIT 7";

        $relatedSchemas=$db->query($relatedSchemasSql,["Id"=>$id,"CategoryId"=>$detail["CategoryId"],])->fetchAll(PDO::FETCH_ASSOC);
        
       foreach ($relatedSchemas as $key => $item) {
                
        $relatedSchemas[$key]['MainImageName']= Application::$app->tools->getFullImageUrl($item['MainImageName']);                
        $relatedSchemas[$key]['cheapest_price'] = Application::$app->tools->toPersianNumber($item['cheapest_price']);

       }


//        $inGroupSchemasQuery="SELECT
//     Id,
//     SUBSTRING(
//         EnglishName,
//         LENGTH(SUBSTRING_INDEX(EnglishName, ' ', 3)) + 2
//     ) AS RemainingName
// FROM _schemas
// WHERE EnglishName LIKE CONCAT(
//     '%',
//     (
//         SELECT SUBSTRING_INDEX(EnglishName, ' ', 3)
//         FROM _schemas
//         WHERE Id = :Id
//     ),
//     '%'
// );";


       $inGroupSchemasQuery="SELECT
    s.Id,
    SUBSTRING(
        s.EnglishName,
        LENGTH(SUBSTRING_INDEX(s.EnglishName, ' ', 3)) + 2
    ) AS EnglishName,
    COALESCE(
        MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END),
        0
    ) AS cheapest_price
FROM _schemas s
LEFT JOIN products p
    ON p.SchemaId = s.Id
WHERE s.Id != :Id
  AND s.EnglishName LIKE CONCAT(
        '%',
        (
            SELECT SUBSTRING_INDEX(EnglishName, ' ', 3)
            FROM _schemas
            WHERE Id = :Id
        ),
        '%'
    )
GROUP BY
    s.Id,
    s.Name,
    s.MainImageName,
    s.EnglishName
ORDER BY
    CASE
        WHEN COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) = 0
        THEN 1
        ELSE 0
    END,
    COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) ASC;";

    $inGroupSchemas=$db->query($inGroupSchemasQuery,["Id"=>$id])->fetchAll(PDO::FETCH_ASSOC);
        

      foreach ($inGroupSchemas as $key => $item) {
                
        $inGroupSchemas[$key]['cheapest_price'] = Application::$app->tools->toPersianNumber($item['cheapest_price']);

       }
        
        $products=$db->query($productSql,["Id"=>$id,])->fetchAll(PDO::FETCH_ASSOC);
                


        $validProducts = array_filter($products, fn($p) => $p['FinalPrice'] > 0);

$minProduct = null;

if (!empty($validProducts)) {
    $minProduct = array_reduce($validProducts, function($carry, $item) {
        if ($carry === null || $item['FinalPrice'] < $carry['FinalPrice']) {
            return $item;
        }
        return $carry;
    });
}



$minPrice = $minProduct ? Application::$app->tools->toPersianNumber($minProduct['FinalPrice']) : null;

$minProductData = $minProduct ? [
    "Link" => $minProduct['Link'],
    "websiteName" => $minProduct['WebsiteName'],
    "price" => $minPrice
] : null;



        $properties=$db->query($propertiesSql,["Id"=>$id,])->fetchAll(PDO::FETCH_ASSOC);
        
        $images=$db->query($imagesSql,["Id"=>$id,])->fetchAll(PDO::FETCH_ASSOC);



        
    if (isset($detail)) {
        $detail['MainImageName']=(isset($_SERVER['HTTPS']) ? 'https://' : 'http://') .$_SERVER['HTTP_HOST'].Application::$app->root_route.'/images/'.$detail['MainImageName'];
    }

    
    foreach ($products as $key => $item) {    
    $products[$key]['FinalPrice'] = Application::$app->tools->toPersianNumber($item['FinalPrice']);
}


    foreach ($images as $key => $item) {
    $images[$key]['Name'] = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') .$_SERVER['HTTP_HOST'].Application::$app->root_route.'/images/'.$images[$key]['Name'];
}
        

        $result=[
            "is_success"=>true,
            "data"=>[
                "detail"=>$detail,
                "products"=>$products, 
                "products_count"=>Application::$app->tools->toPersianNumber(count($products)), 
                "minProductData"=>$minProductData,  
                "properties"=>$properties,
                "images"=>$images,
                "related_schemas"=>$relatedSchemas,
                "in_group_schemas"=>$inGroupSchemas,
            ]
        ];


    return $result;
    //print_r(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        } catch (Exception  $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

   

}