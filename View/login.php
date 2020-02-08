<!DOCTYPE html>
<!--<html>
    <head></head>
    <body>-->
        <?php
        include 'View/title.php'; // print titles
        
        if (isset($_SESSION['adminUser'])){
            if (isset($_SESSION['destFile'])){
                unlink($_SESSION['destFile']);
                unset ($_SESSION['destFile']);
            }
            session_destroy();
            $_SESSION = array();
            $_GET = array();
        }
        
        // check for login errors and print message if they exist
        if (isset($loginError) && $loginError) {
            echo "Invalid username or password, please try again.";
        }
        ?>
        
        <!--    log in form
                calls upload when button is pressed and posts username and password-->
        <form name="loginForm" id="loginForm" action="index.php?upload" method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </p>
            <p>
                <input type="submit" value="Login">
            </p>
        </form>
<!--    </body>
</html>-->

