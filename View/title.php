<h1>POKER HANDS</h1>
<?php 

if (!isset($_SESSION['adminUser'])){?>
    <h2>Login</h2>
<?php} elseif (isset($_GET['results'])) {?>
    <h2>The results are:</h2>
<?php } else {?>
    <h2>Who's the winner?</h2>
<?php }
