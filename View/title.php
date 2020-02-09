<h1>POKER HANDS</h1>
<h2>Who's the winner?</h2>

<?php

// if not logged in (adminUser is not set in Session)
    // Sub-Title = Login
// else if result page is called
    // Sub-Title = The results are:
// else Sub-Title = Upload file
if (!isset($_SESSION['adminUser'])){
    echo "<h3>Login</h3>";
} else if (isset($_GET['results'])){
    echo "<h3>The results are:</h3>";
} else {
    echo "<h3>Upload file</h3>";
}