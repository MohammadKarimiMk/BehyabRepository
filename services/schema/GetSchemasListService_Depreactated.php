<?php
namespace services;

use core\Application;

use PDO;

class GetSchemasListService {
    
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
    public function execute($current_page,$categoryId=null) {
        try {
        
        $db = Application::$app->db;

        $per_page=20;
        $offset = ($current_page - 1) * $per_page;
        
        $whereClause = $categoryId !== null ? ' WHERE categoryId = :categoryId' : '';
        $countQuery='SELECT COUNT(*) as total FROM _schemas'. $whereClause;

        $total=0;

        if($categoryId!=null){
            $total=($db->query($countQuery,["categoryId"=>$categoryId])->fetch(PDO::FETCH_ASSOC))['total'];
        }
        else{
            $total=($db->query($countQuery)->fetch(PDO::FETCH_ASSOC))['total'];
        }

        //$total=($db->query('SELECT COUNT(*) as total FROM _schemas')->fetch(PDO::FETCH_ASSOC))['total'];

//         $sql = "SELECT 
//     s.Id,
//     s.Name,
//     s.MainImageName,
//     COALESCE(
//         MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END),
//         0
//     ) AS cheapest_price
// FROM _schemas s
// LEFT JOIN products p ON p.SchemaId = s.Id"
// .$whereClause.
// "GROUP BY s.Id, s.Name
// ORDER BY 
//     CASE WHEN COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) = 0 
//          THEN 1 ELSE 0 END,
//     COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) ASC
//         LIMIT :per_page OFFSET :offset;";


$sql = "SELECT 
    s.Id,
    s.Name,
    s.MainImageName,
    COALESCE(
        MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END),
        0
    ) AS cheapest_price
FROM _schemas s
LEFT JOIN products p ON p.SchemaId = s.Id
{$whereClause}
GROUP BY s.Id, s.Name
ORDER BY 
    CASE WHEN COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) = 0 
         THEN 1 ELSE 0 END,
    COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) ASC
LIMIT :per_page OFFSET :offset";
        
        $schemas= null;

        if($categoryId!=null){
            $schemas=$db->query($sql,["categoryId"=>$categoryId,"per_page"=>$per_page,"offset"=>$offset,])->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            $schemas=$db->query($sql,["per_page"=>$per_page,"offset"=>$offset,])->fetchAll(PDO::FETCH_ASSOC);
        }

        //$schemas=$db->query($sql,["per_page"=>$per_page,"offset"=>$offset,])->fetchAll(PDO::FETCH_ASSOC);

        
       foreach ($schemas as &$item) {
    if (isset($item['cheapest_price'])) {
        $item['cheapest_price'] = $this->toPersianNumber($item['cheapest_price']);
        $item['MainImageName']=(isset($_SERVER['HTTPS']) ? 'https://' : 'http://') .$_SERVER['HTTP_HOST'].Application::$app->root_route.'/images/'.$item['MainImageName'];
    }
}
        

        $result=[
            "data"=>$schemas,
            "hasMore"=>($offset+$per_page)<$total,   
            "offset"=>$offset,
            "per_page"=>$per_page,
            "total"=>$total,
        ];


    return $result;
    //print_r(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        } catch (Exception  $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

   

}