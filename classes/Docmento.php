<?php
require_once 'DB.php';

class Docmento {
    private $_db;
    
    public function __construct() {
        $this->_db = DB::getInstance();
    }
    
    public function insert($data) {
        if (!$this->_db->insertDoc('credencial', $data)) {
            return false;
        }
        return true;
    }
    
}