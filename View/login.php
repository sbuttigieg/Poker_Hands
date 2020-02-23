<?php
include 'View/title.php'; // print titles

// if session was exited abruptly with clearing it
// deleted uploaded file and delete session and its variables
if (isset($_SESSION['adminUser'])){
    if (isset($_SESSION['destFile'])){
        unlink($_SESSION['destFile']);
        unset ($_SESSION['destFile']);
    }
    session_destroy();
    $_SESSION = [];
    $_GET = [];
}?>

<div class="row">
    <div class="col-md-3"></div>  
    <div class="col-md-6 align-self-center">
        <!--    log in form that calls upload when button is pressed and posts
                username and password   -->
        <form class="form-signin" name="loginForm" id="loginForm" 
            action="index.php?upload" method="POST">
                <label class="sr-only" for="username">Username</label>
                <input class="form-control" placeholder="Username" 
                       required autofocus type="text" id="username" 
                       name="username">
                <label class="sr-only" for="password">Password</label>
                <input class="form-control" placeholder="password" 
                       required type="password" id="password" name="password">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form> 
        <?php
        // check for login errors and print message if they exist
        if (isset($loginError) && $loginError) {
            echo "<h6 class=\"text-center\" style=\"color:red;\">"
                . "Invalid username or password, please try again.<h6>";
        }?>
    </div>
    <div class="col-md-3"></div>
</div>