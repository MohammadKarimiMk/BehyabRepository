<?php
namespace services;

use core\Application;

use PDO;

class MapSqliteToMysqlService {
    private $pdo;
    private $db;
    
    public function execute() {
        try {
               //$db = Application::$app->db;


                  // SQLite database file path
    //$database_path = __DIR__ . '/database.sqlite';
    $database_path = 'databases/ProductCrawlerDb.db';
    
    // Create PDO connection
    $this->pdo = new PDO("sqlite:$database_path");    
    
    // Set error mode to exception
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $this->db = Application::$app->db;


    $this->remove_all_records();



    $this->add_categories();
    $this->add_schemas();
    $this->add_products();
    $this->add_images();
    $this->add_properties();


   

        } catch (Exception  $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

    private function remove_all_records() {
          
        
        $sql = "
        
DELETE FROM properties;

DELETE FROM images;

DELETE FROM products;

DELETE FROM _schemas;

DELETE c1 FROM categories c1
LEFT JOIN categories c2 ON c2.ParentId = c1.id
WHERE c1.ParentId IS NOT NULL  -- اگر می‌خواهید فقط زیردسته‌ها را حذف کنید (اختیاری)
  AND c2.id IS NULL;


DELETE FROM categories WHERE ParentId IS NOT NULL;

DELETE FROM categories;



        ";
        $this->db->query($sql);
        
    }



    private function add_categories() {
        $stmt = $this->pdo->query("SELECT * FROM Categories");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $sql = "INSERT INTO categories (Id,Name, ParentId) VALUES (:Id, :Name, :ParentId)";
        $this->db->query($sql,
        [
        'Id' => $row["Id"],
        'Name' => $row["Name"],
        'ParentId' => $row["ParentId"],
         ],

         )
         ;
        }
    }


        private function add_schemas() {
        $stmt = $this->pdo->query("SELECT * FROM Schemas");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $sql = "INSERT INTO _Schemas (Id,EnglishName,Name,MainImageName, CategoryId) VALUES (:Id,:EnglishName, :Name,:MainImageName, :CategoryId)";
        $this->db->query($sql,
        [
        'Id' => $row["Id"],
        'EnglishName' => $row["EnglishName"],
        'Name' => $row["Name"],
        'MainImageName' => $row["MainImageName"],
        'CategoryId' => $row["CategoryId"],
         ],

         )
         ;
        }
    }



    
        private function add_products() {
        $stmt = $this->pdo->query("SELECT * FROM Products");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $sql = "INSERT INTO Products (Id,Name,Link,FinalPrice,SchemaId) VALUES (:Id,:Name,:Link,:FinalPrice, :SchemaId)";
        $this->db->query($sql,
        [
        'Id' => $row["Id"],
        'Name' => $row["Name"],
        'Link' => $row["Link"],
        'FinalPrice' => $row["FinalPrice"],
        'SchemaId' => $row["SchemaId"],
         ],

         )
         ;
        }
    }



            private function add_images() {
        $stmt = $this->pdo->query("SELECT * FROM Images");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $sql = "INSERT INTO Images (Id,Name,Source,SchemaId) VALUES (:Id,:Name,:Source, :SchemaId)";
        $this->db->query($sql,
        [
        'Id' => $row["Id"],
        'Name' => $row["Name"],
        'Source' => $row["Source"],
        'SchemaId' => $row["SchemaId"],
         ],

         )
         ;
        }
    }

    

    
            private function add_properties() {
        $stmt = $this->pdo->query("SELECT * FROM Properties");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $sql = "INSERT INTO Properties (Id,_Key,_Value,SchemaId) VALUES (:Id,:_Key,:_Value, :SchemaId)";
        $this->db->query($sql,
        [
        'Id' => $row["Id"],
        '_Key' => $row["_Key"],
        '_Value' => $row["_Value"],
        'SchemaId' => $row["SchemaId"],
         ],

         )
         ;
        }
    }

}