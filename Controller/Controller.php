<?php

session_start();
require_once 'Model/Model.php';

class Controller {

    public $model;

    public function __construct() {
       $this->model = new Model();
    }
    
    public function invoke() {
        
        // Show login screen
        include 'View/login.php';
    }
}
