<?php
require_once 'Controller/Controller.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Poker Hands</title>
    </head>
    <body>
        <?php
        include 'View/title.php';
        $controller = new Controller();
        $controller->invoke();
        ?>
    </body>
</html>
