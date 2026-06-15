<?php
namespace core;

class View
{
    protected $layout = 'main';      // نام پیش‌فرض layout (بدون پسوند)
    protected static $data = [];            // داده‌های مشترک بین layout و view
    protected static $sections = []; // برای ذخیره‌سازی بخش‌های مختلف (content, sidebar و ...)
    protected static $currentSection = null; // برای ذخیره‌سازی بخش‌های مختلف (content, sidebar و ...)

    /**
     * رندر کردن یک view با layout مشخص
     * @param string $view  مسیر view (مثل 'home.index')
     * @param array $data   داده‌هایی که به view ارسال می‌شود
     * @param string|null $layout نام layout (اگر null باشد، بدون layout رندر می‌کند)
     */
    public static function render($view, $data = [], $layout = null)
    {
        $viewPath = self::getViewFile($view);
        if (!file_exists($viewPath)) {
            die("View not found: " . $viewPath);
        }

        // اگر layout مشخص نشده، از پیش‌فرض استفاده کن
        if ($layout === null) {
            $layout = self::getDefaultLayout();
        }

        // داده‌ها را در دسترس view و layout قرار می‌دهیم
        $data = array_merge(self::$data, $data);
        extract($data);

        // اگر layout مشخص شده، بافر کردن محتوای view و سپس قراردادن در layout
        if ($layout !== false) {
            ob_start();
            require $viewPath;
            $content = ob_get_clean();

            // بخش‌های دیگر (مثل sidebar, header) هم از طریق بافر مشابه جمع‌آوری می‌شوند
            // اما برای سادگی، فعلاً فقط 'content' را تعریف می‌کنیم
            self::$sections['content'] = $content;

            // رندر کردن layout
            $layoutPath = self::getLayoutFile($layout);
            if (!file_exists($layoutPath)) {
                die("Layout not found: " . $layoutPath);
            }
            require $layoutPath;
        } else {
            // بدون layout، فقط view را مستقیم رندر کن
            require $viewPath;
        }
    }

    /**
     * شروع یک بخش (برای پر کردن محتوای بخش‌های مختلف در layout)
     * @param string $name نام بخش (مثل 'sidebar')
     */
    public static function startSection($name)
    {
        ob_start();
        self::$sections[$name] = null;
        self::$currentSection = $name;
    }

    /**
     * پایان یک بخش
     */
    public static function endSection()
    {
        $content = ob_get_clean();
        if (self::$currentSection) {
            self::$sections[self::$currentSection] = $content;
            self::$currentSection = null;
        }
    }

    /**
     * نمایش محتوای یک بخش در layout
     * @param string $name
     * @param string $default مقدار پیش‌فرض اگر بخش وجود نداشت
     */
    public static function yieldSection($name, $default = '')
    {
        echo self::$sections[$name] ?? $default;
    }

    /**
     * رندر کردن یک partial (قطعه)
     * @param string $partial نام partial (مثل 'partials.header')
     * @param array $data داده‌های اختصاصی برای partial
     */
    public static function partial($partial, $data = [])
    {

     // دریافت داده‌های کامپوزر برای این partial
    $composerData = ViewComposer::getData($partial);
    
    // ادغام داده‌ها (داده‌های ارسالی اولویت دارند)
    $data = array_merge($composerData, $data);

        $partialPath = self::getPartialFile($partial);
        if (!file_exists($partialPath)) {
            die("Partial not found: " . $partialPath);
        }
        extract($data);
        require $partialPath;
    }

    // ---------- متدهای کمکی برای یافتن مسیر فایل‌ها ----------
    protected static function getViewFile($view)
    {
        $view = str_replace('.', '/', $view);        
        //return "app/Views/{$view}.php";
        return "app/Views/Pages/{$view}/index.php";
    }

    protected static function getLayoutFile($layout)
    {
        return "app/Views/layouts/{$layout}.php";
    }

    protected static function getPartialFile($partial)
    {
        $partial = str_replace('.', '/', $partial);
        return "app/Views/{$partial}.php";
    }

    protected static function getDefaultLayout()
    {
        // می‌توانید از یک متغیر سراسری یا کانفیگ بخوانید
        return 'main';
    }
}