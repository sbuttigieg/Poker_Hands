<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php include 'View/title.php'; // print titles ?>
        <p> I'm in Upload </p>
        <?php 
        // if user is logged in, show logout button
        // calls logout if pressed
        if (isset($_SESSION['adminUser'])){?>
            <form name="logoutForm" id="logoutForm" action="index.php?logout" method="POST">
                <button type="submit" value="Logout">Logout</button>
            </form>
        <?PHP }?>
    </body>
</html>