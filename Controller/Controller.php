<?php

session_start();
require_once 'Model/Model.php';

class Controller {

    public $model;

    public function __construct() {
       $this->model = new Model();
    }
    
    public function invoke() {
        if ((isset($_GET['results']))&&(isset($_SESSION['adminUser']))&&(isset($_SESSION['destFile']))){
            include 'View/results.php';
        } else if ((isset($_GET['upload']))&&(isset($_SESSION['adminUser']))) {
            unset ($_SESSION['destFile']);
            include 'View/upload.php';
        } else if (isset($_POST['username']) && isset($_POST['password'])){
            if ($this->model->checkLogin($_POST['username'], $_POST['password'])) {
                $_SESSION['adminUser'] = $_POST['username'];
                include 'View/upload.php';
            } else {
                $loginError = true;
                $_GET = array();
                include 'View/login.php';
            }
        } else if (isset($_GET['logout'])) {
            session_destroy();
            $_SESSION = array();
            $_GET = array();
            $this->model->clearResults();
            include 'View/login.php';
        } else {
            // Show login screen
            include 'View/login.php';
        }
    }
}