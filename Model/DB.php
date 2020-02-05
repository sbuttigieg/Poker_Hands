<?php

class DB {
    private static $_singleton;
    private $_connection;
    
    private function __construct(){
        $this->_connection = new PDO(
                "mysql:host=localhost;dbname=pokerhands",
                "root",
                "");
        $this->_connection->exec("SET CHARACTER SET utf8");      
    }
    
    public static function getInstance(){
        if (is_null(self::$_singleton)){
            self::$_singleton= new DB();
        }
        return self::$_singleton;
    }
    
    public function getHandler() {
        return $this->_connection;
    }
}