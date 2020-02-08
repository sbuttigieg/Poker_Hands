<?php

session_start();
require_once 'Model/Model.php';

class Controller {

    public $model;

    public function __construct() {
       $this->model = new Model();
    }
    
    // function used to remove the destination file and its saved location when 
    // exiting the upload or results page
    private static function cleanExit(){
        if (isset($_SESSION['destFile'])){
            unlink($_SESSION['destFile']);
            unset ($_SESSION['destFile']);
        }
    }
    public function invoke() {
        if ((isset($_GET['results']))&&(isset($_SESSION['adminUser']))&&(isset($_SESSION['destFile']))){
            include 'View/results.php';
        } else if ((isset($_GET['upload']))&&(isset($_SESSION['adminUser']))) {
            self::cleanExit();
            $this->model->clearResults();
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
            self::cleanExit();
            $this->model->clearResults();
            session_destroy();
            $_SESSION = array();
            $_GET = array();
            include 'View/login.php';
        } else {
            // Show login screen
            include 'View/login.php';
        }
    }
}