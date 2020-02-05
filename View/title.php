<h1>POKER HANDS</h1>
<?php 

if (!isset($_SESSION['adminUser'])){
    echo "<h2>Login</h2>";
} else if (isset($_GET['results'])){
    echo "<h2>The results are:</h2>";
} else {
    echo "<h2>Who's the winner?</h2>";
}
