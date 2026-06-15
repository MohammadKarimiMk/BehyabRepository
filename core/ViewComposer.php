<?php
namespace core;

class ViewComposer
{
    private static $sharedData = [];
    
    /**
     * ثبت یک کامپوزر برای یک partial خاص
     */
    public static function compose($partialName, callable $callback)
    {
        self::$sharedData[$partialName] = $callback;
    }
    
    /**
     * دریافت داده‌های یک partial (قبل از رندر)
     */
    public static function getData($partialName)
    {
        if (isset(self::$sharedData[$partialName])) {
            $callback = self::$sharedData[$partialName];
            return $callback();
        }
        
        return [];
    }
}