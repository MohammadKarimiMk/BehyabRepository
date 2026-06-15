<?php
namespace core;

require_once 'core/View.php';


class Controller {
    public function view($view, $data = [], $layout = null) {
    View::render($view, $data, $layout);
    }
    
    public function redirect($url) {
        header("Location: $url");
        exit();
    }
        // همچنین می‌توانید دسترسی به متدهای View را از طریق Controller هم فراهم کنید
    protected function startSection($name)
    {
        View::startSection($name);
    }

    protected function endSection()
    {
        View::endSection();
    }

    protected function partial($partial, $data = [])
    {
       
        
        View::partial($partial, $data);
    }
    protected function json_response($data,$status_code)
    {
        http_response_code($status_code);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}