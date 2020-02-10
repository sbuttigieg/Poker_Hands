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
    
    public function saveResults($results) {
        $st = $this->conn->getHandler()->prepare
            ("INSERT INTO results(card1, card2, card3, card4, card5, card6, card7, card8, card9, card10) VALUES (:1, :2, :3, :4, :5, :6, :7, :8, :9, :10)");
        $st->bindParam(':1', $results[0]);
        $st->bindParam(':2', $results[1]);
        $st->bindParam(':3', $results[2]);
        $st->bindParam(':4', $results[3]);
        $st->bindParam(':5', $results[4]);
        $st->bindParam(':6', $results[5]);
        $st->bindParam(':7', $results[6]);
        $st->bindParam(':8', $results[7]);
        $st->bindParam(':9', $results[8]);
        $st->bindParam(':10', $results[9]);
        $st->execute();
    }
    
    public function clearResults() {
        $st = $this->conn->getHandler()->prepare("TRUNCATE TABLE results");
        $st->execute();
    }
    
    public function getResults($playerNumber) {
        if ($playerNumber == 1){
            $st = $this->conn->getHandler()->prepare("SELECT card1, card2, card3, card4, card5 FROM results");
        } else if ($playerNumber == 2){
            $st = $this->conn->getHandler()->prepare("SELECT card6, card7, card8, card9, card10 FROM results");
        }
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_NUM);
        return $result;
    }
}