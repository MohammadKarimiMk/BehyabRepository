<?php
namespace core;

class Model {
    protected $db;
    protected $table;
    
    public function __construct() {
        $this->db = Application::$app->db;
    }
    
    public function all() {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }
    
    public function find($id) {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
        return $stmt->fetch();
    }
}