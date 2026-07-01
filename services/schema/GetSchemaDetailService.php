<?php
namespace services;

use core\Application;

use PDO;

class GetSchemaDetailService {
    

    private function toPersianNumber($number) {
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    
    // اگر عدد اعشاری است، اول فرمت می‌کنیم
    if (is_numeric($number)) {
        $formatted = number_format((float)$number);
        return str_replace($english, $persian, $formatted);
    }
    
    return str_replace($english, $persian, (string)$number);
}

    public function execute($id) {
        try {
        
        $db = Application::$app->db;

              
        $schemaSql = "SELECT * FROM _schemas WHERE Id= :Id";
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
        
        $products=$db->query($productSql,["Id"=>$id,])->fetchAll(PDO::FETCH_ASSOC);

        

        // $prices = array_column($products, 'FinalPrice');
        // // keep only values > 0
        // $prices = array_filter($prices, fn($p) => $p > 0);

        // $minPrice = !empty($prices) ? min($prices) : null;
        
        // $minPrice=$this->toPersianNumber($minPrice);


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

$minPrice = $minProduct ? $this->toPersianNumber($minProduct['FinalPrice']) : null;

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
    $products[$key]['FinalPrice'] = $this->toPersianNumber($item['FinalPrice']);
}


    foreach ($images as $key => $item) {
    $images[$key]['Name'] = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') .$_SERVER['HTTP_HOST'].Application::$app->root_route.'/images/'.$images[$key]['Name'];
}
        

        $result=[
            "is_success"=>true,
            "data"=>[
                "detail"=>$detail,
                "products"=>$products, 
                "products_count"=>$this->toPersianNumber(count($products)), 
                "minProductData"=>$minProductData,  
                "properties"=>$properties,
                "images"=>$images,
            ]
        ];


    return $result;
    //print_r(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        } catch (Exception  $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

   

}