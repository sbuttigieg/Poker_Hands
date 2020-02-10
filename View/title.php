<div style="background-color: black;" class="page-header">
    <div class="row">
        <div class="col-md-4 align-self-center">
            <img class="float-left" src="img/poker-hands-100x82.jpg" alt="Poker Hand" height="82" width="100">
        </div>
        <div class="col-md-4">
                <h1 class="text-center" style="color:red;">POKER HANDS</h1>
                <h2 class="text-center" style="color:white;">Who's the winner?</h2>
        </div>
        <div class="col-md-4 align-self-center">
            <img class="float-right align-middle" src="img/poker-hands-100x82.jpg" alt="Poker Hand" height="82" width="100">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pt-3" style="height:100px;">

<?php
if (!isset($_SESSION['adminUser'])){                        // if not logged in
    echo "<h3 class=\"text-center\">Login</h3>";            // Sub-Title = Login
} else if (isset($_GET['results'])){                        // else if result page is called
    echo "<h3 class=\"text-center\">The results are:</h3>"; // Sub-Title = The results are:
} else {
    echo "<h3 class=\"text-center\">Upload file</h3>";      // else Sub-Title = Upload file
}?>
    </div>
</div>