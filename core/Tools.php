<?php
namespace core;
use core\Application;

class Tools
{
  
    public function toPersianNumber($number) {
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    
    // اگر عدد اعشاری است، اول فرمت می‌کنیم
    if (is_numeric($number)) {
        $formatted = number_format((float)$number);
        return str_replace($english, $persian, $formatted);
    }
    
    return str_replace($english, $persian, (string)$number);
}

    public function getFullImageUrl($imageName){
        return (isset($_SERVER['HTTPS']) ? 'https://' : 'http://')
        . $_SERVER['HTTP_HOST']
        . Application::$app->root_route
        . '/images/'
        . $imageName;
    }

}