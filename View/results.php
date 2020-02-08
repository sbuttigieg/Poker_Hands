<?php
include 'View/title.php'; // print titles 

// Function used to check the validity of each row of cards before
// they are stored in the database
function checkData($data){
    // check there are 10 cards in a row
    if (count($data)!==10){
        echo "<br>Count: ". count($data);
        return false;
    }
    for ($x=0; $x<=9; $x++){
        // check that each card contains 2 characters 
        if (strlen($data[$x]) !==2){
            echo "<br>$data[$x] Length: ". strlen($data[$x]);
            return false;
        }
        // check that the value of the card is 2 to 9, T, J, Q, K, A
        $char1 = substr($data[$x], 0, 1);
        if (!checkValue($char1)){
            return false;
        }
        // check that the suit of the card is S, H, D, C
        $char2 = substr($data[$x], 1, 1);
        if (!checkSuit($char2)){
            return false;
        }
    }
    return true;
}

// Function used to check that the value of the card is 2 to 9, T, J, Q, K, A
function checkValue($value){
    if ((($value > 1)&&($value <= 9)) || ($value == "T") || ($value == "J") 
            || ($value == "Q")|| ($value == "K")|| ($value == "A")){
        return true;
    } else {
        echo "<br>Value $value is not ok";
        return false;
    }
}

// Function used to check that the suit of the card is S, H, D, C
function checkSuit($suit){
    if (($suit == "S") || ($suit == "H") || ($suit == "D")|| ($suit == "C")){
        return true;
    } else {
        echo "<br>Suit $suit is not ok";
        return false;
    }
}

// Read the uploaded file and check validity.
// If valid, write the contents to the database
if (($handle = fopen($_SESSION['destFile'], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 30, " ")) !== FALSE) {
        if (!checkData($data)){
            echo "<br>Wrong Data";
            break;
        }
        $this->model->saveResults($data);
    }
}
fclose($handle);

// if user is logged in, show logout button
// calls logout when button is pressed  
if (isset($_SESSION['adminUser'])){?>
    <form name="logoutForm" id="logoutForm" action="index.php?logout" method="POST">
        <button type="submit">Logout</button>
    </form>
<?PHP }?>
