<?php
namespace services;

use core\Application;
use PDO;

class GetSchemasListService {
    
    private function toPersianNumber($number) {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        
        if (is_numeric($number)) {
            $formatted = number_format((float)$number);
            return str_replace($english, $persian, $formatted);
        }
        
        return str_replace($english, $persian, (string)$number);
    }
    
    public function execute($current_page, $categoryId = null) {
        try {
            $db = Application::$app->db;
            $per_page = 20;
            $offset = ($current_page - 1) * $per_page;
            
            // اگر categoryId وجود داشته باشد، تمام زیرمجموعه‌ها را پیدا می‌کنیم
            if ($categoryId !== null) {
                // 1. ابتدا تمام IDهای زیرمجموعه (مستقیم و غیرمستقیم) را پیدا می‌کنیم
                $categoryIds = $this->getAllSubCategoryIds($categoryId, $db);
                
                // 2. اگر هیچ زیرمجموعه‌ای وجود نداشته باشد، فقط خود categoryId را در نظر می‌گیریم
                if (empty($categoryIds)) {
                    $categoryIds = [$categoryId];
                }
                
                // 3. ساخت جایگاه‌های پارامتری برای IN clause
                $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
                
                // 4. کوئری اصلی با استفاده از categoryIds
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
                WHERE s.categoryId IN ($placeholders)
                GROUP BY s.Id, s.Name
                ORDER BY 
                    CASE WHEN COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) = 0 
                         THEN 1 ELSE 0 END,
                    COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) ASC
                LIMIT ? OFFSET ?";
                
                // 5. اجرای کوئری با پارامترها
                $params = array_merge($categoryIds, [$per_page, $offset]);
                $schemas = $db->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
                
                // 6. محاسبه تعداد کل برای pagination
                $countSql = "SELECT COUNT(*) as total FROM _schemas WHERE categoryId IN ($placeholders)";
                $total = $db->query($countSql, $categoryIds)->fetch(PDO::FETCH_ASSOC)['total'];
                
            } else {
                // اگر categoryId null باشد، همه schema ها را نمایش می‌دهیم
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
                GROUP BY s.Id, s.Name
                ORDER BY 
                    CASE WHEN COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) = 0 
                         THEN 1 ELSE 0 END,
                    COALESCE(MIN(CASE WHEN p.FinalPrice > 0 THEN p.FinalPrice END), 0) ASC
                LIMIT ? OFFSET ?";
                
                $schemas = $db->query($sql, [$per_page, $offset])->fetchAll(PDO::FETCH_ASSOC);
                $countSql = "SELECT COUNT(*) as total FROM _schemas";
                $total = $db->query($countSql)->fetch(PDO::FETCH_ASSOC)['total'];
            }
            
            // فرمت کردن خروجی
            foreach ($schemas as &$item) {
                if (isset($item['cheapest_price'])) {
                    $item['cheapest_price'] = $this->toPersianNumber($item['cheapest_price']);
                    $item['MainImageName'] = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . 
                        $_SERVER['HTTP_HOST'] . Application::$app->root_route . '/images/' . $item['MainImageName'];
                }
            }
            
            return [
                "data" => $schemas,
                "hasMore" => ($offset + $per_page) < $total,
                "offset" => $offset,
                "per_page" => $per_page,
                "total" => $total,
            ];
            
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    /**
     * دریافت تمام IDهای زیرمجموعه‌های یک category (به صورت بازگشتی)
     */
    private function getAllSubCategoryIds($parentId, $db) {
        $result = [];
        
        // فرض می‌کنیم جدول categories با ساختار زیر وجود دارد:
        // CREATE TABLE categories (
        //     Id INT PRIMARY KEY,
        //     ParentId INT NULL,
        //     Name VARCHAR(255)
        // );
        
        // استفاده از Recursive CTE برای پیدا کردن همه زیرمجموعه‌ها
        $sql = "
            WITH RECURSIVE CategoryHierarchy AS (
                -- عضو پایه: خود category مورد نظر
                SELECT Id, ParentId
                FROM categories
                WHERE Id = ?
                
                UNION ALL
                
                -- عضو بازگشتی: فرزندان
                SELECT c.Id, c.ParentId
                FROM categories c
                INNER JOIN CategoryHierarchy ch ON ch.Id = c.ParentId
            )
            SELECT Id FROM CategoryHierarchy
            WHERE Id != ?  -- خود parent را حذف می‌کنیم (اختیاری)
        ";
        
        // اجرای کوئری
        $stmt = $db->query($sql, [$parentId, $parentId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // استخراج IDها
        foreach ($rows as $row) {
            $result[] = (int)$row['Id'];
        }
        
        return $result;
    }
}