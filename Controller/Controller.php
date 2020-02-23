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
        if ((null !== (filter_input(INPUT_GET, 'results', FILTER_SANITIZE_STRING)))
                &&(isset($_SESSION['adminUser']))&&(isset($_SESSION['destFile']))){
            include 'View/results.php';
        } else if ((null !== (filter_input(INPUT_GET, 'upload', FILTER_SANITIZE_STRING)))
                &&(isset($_SESSION['adminUser']))) {
            self::cleanExit();
            $this->model->clearResults();
            include 'View/upload.php';
        } else if (null !== (filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING))
                && null !== (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))){
            $inputUsr = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $inputPwd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            if ($this->model->checkLogin($inputUsr, $inputPwd)) {
                $_SESSION['adminUser'] = $inputUsr;
                include 'View/upload.php';
            } else {
                $loginError = true;
                $_GET = [];
                include 'View/login.php';
            }
        } else if (null !== (filter_input(INPUT_GET, 'logout', FILTER_SANITIZE_STRING))) {
            self::cleanExit();
            $this->model->clearResults();
            session_destroy();
            $_SESSION = [];
            $_GET = [];
            include 'View/login.php';
        } else {
            // Show login screen
            include 'View/login.php';
        }
    }
}