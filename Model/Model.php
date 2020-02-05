<?php

require_once 'DB.php';

class Model {
    private $conn;
    
    public function __construct(){
        $this->conn = DB::getInstance();
    }
    
    public function checkLogin($username, $password) {
        $hashed = sha1($password);
        $st = $this->conn->getHandler()->prepare("SELECT * FROM admin WHERE username = :u AND password = :p");
        $st->bindParam(':u', $username);
        $st->bindParam(':p', $hashed);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_OBJ);
        return $result != null;   //returns true or false
    }
}