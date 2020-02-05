<?php

session_start();
require_once 'Model/Model.php';

class Controller {

    public $model;

    public function __construct() {
       $this->model = new Model();
    }
    
    public function invoke() {
        if (isset($_GET['results'])){
            include 'View/results.php';
        } else if (isset($_GET['admin'])) {
            include 'View/upload.php';
        } else {
            // Show login screen
            include 'View/login.php';
        }
    }
}
