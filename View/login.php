<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php
        if (isset($loginError) && $loginError) {
            echo "Invalid username or password, please try again.";
        }
        ?>
        
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
    </body>
</html>

