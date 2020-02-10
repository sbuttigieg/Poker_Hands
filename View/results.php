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

// function used to convert all values into integers to enable calculations 
function convertValue($value){
    switch ($value){
        case 'T': $value = 10; break;
        case 'J': $value = 11; break;
        case 'Q': $value = 12; break;
        case 'K': $value = 13; break;
        case 'A': $value = 14; break;
        default: $value = intval($value);
    }
    return $value;
}

// function used to create a sorted array with removed suits and 
// letters converted to numbers
function getValue($hand){
    for ($x = 0; $x < count($hand); $x++ ){
        $handValue[$x] = substr($hand[$x], 0, 1);
        $handValue[$x] = convertValue($handValue[$x]);
        sort($handValue);
    }
    return $handValue;
}

// function used to create an array with removed values (suits only)
function getSuit($hand){
    for ($x = 0; $x < count($hand); $x++ ){
        $handSuit[$x] = substr($hand[$x], 1, 1);
    }
    return $handSuit;
}

// function used to determine if a hand has duplicate values
function hasDuplicates($hand){
    return ((count(array_unique($hand))<count($hand)) ? true : false);
}

// function used to count the highest value of the duplicate numbers
function highestDuplicate($array){
    $duplicates = array_unique(array_diff_assoc($array, array_unique($array)));
    return max($duplicates);
}

// function used to count the highest value of non duplicate numbers
function highestNonDuplicate($array){
    $duplicates = array_unique(array_diff_assoc($array, array_unique($array)));
    $notDuplicates = array_diff($array, $duplicates);
    return max($notDuplicates);
}

// function used to count the highest value of the duplicate numbers in a hand
function handHighestDuplicate($hand, $type="normal"){
    switch ($type){
        case "Full House": {
            $FH = array($hand[0],$hand[1],$hand[2]);
            $unique = count(array_unique($FH));
            if ($unique !== 1){
                $FH = [$hand[2],$hand[3],$hand[4]];
            }
            $highestValue = highestDuplicate($FH);
            break;
        }
        default: {
            $highestValue = highestDuplicate($hand);
        }
    }
    return $highestValue;
}

// function used to determine if numbers are sequential
function isSequential ($numbers){
    for ($x = 1; $x < count($numbers); $x++ ){
        if ($numbers[$x] !== ($numbers[$x-1]+1)){
            return false;
        }
    }
    return true;
}

// function used to determine if all suits in a hand are the same
function sameSuits($hand){
    return ((count(array_unique($hand))==1) ? true : false);
}

//function used to determine the score when duplicates are involved
function rankingDuplicates($hand){
    $unique = count(array_unique($hand));
    if ($unique === 4){
        return [9, handHighestDuplicate($hand),highestNonDuplicate($hand)];     // score is a Pair
    } else if ($unique == 3){
        if (($hand[0] === $hand[1]) && ($hand[1] === $hand[2]) ||
            ($hand[1] === $hand[2]) && ($hand[2] === $hand[3]) ||
            ($hand[2] === $hand[3]) && ($hand[3] === $hand[4])){
            return [7, handHighestDuplicate($hand),0];                          // score is a Three of a kind
        } else {
            return [8, handHighestDuplicate($hand),highestNonDuplicate($hand)]; // score is a Two Pairs
            }
    } else if ($unique === 2){
        if (($hand[1] === $hand[2]) && ($hand[2] === $hand[3])){
            return [3, handHighestDuplicate($hand),0];                          // score is aFour of a kind
        } else {return [4, handHighestDuplicate($hand, "Full House"),0];}       // score is aFull House
    }
}

// function used to determine the score of a hand
function getScore($hand){
    $handValue = getValue($hand); // Derive sorted array with values only
    $handSuit = getSuit($hand); // Derive array with suits only
    for ($a = 0; $a < count($hand); $a++ ){echo "$hand[$a] ";} //show hand
    // check for duplicates. If there are, run duplicates algorithm
    if (hasDuplicates($handValue)){
        return rankingDuplicates($handValue);
    } else {                                        //no duplicates
        if (isSequential($handValue)){              // check if sequential
            $highestValue = max($handValue);        // check highest value
            if(sameSuits($handSuit)){               // check if same suits
                if ($highestValue == 14){           // check if highest values is an Ace
                    return [1,$highestValue,0];     // score is a Royal Flush
                } else {return [2,$highestValue,0];}// score is a Straight Flush
            } else {return [6,$highestValue,0];}    // score is a Straight
        } else {                                    // not sequential
            $highestValue = max($handValue);        // check highest value
            if(sameSuits($handSuit)){               // check if same suits
                return [5,$highestValue,0];         // score is a Flush
            } else {return [10,$highestValue,0];}   // score is a High Card
        }
    }
}

// Compare results for each game
function gameWinner($scorePlayer1, $scorePlayer2){
    if ($scorePlayer1[0] < $scorePlayer2[0]){
        $winner = 1;
    } else if ($scorePlayer1[0] > $scorePlayer2[0]){
        $winner = 2;
    } else if ($scorePlayer1[1] > $scorePlayer2[1]){
        $winner = 1;
    } else if ($scorePlayer1[1] < $scorePlayer2[1]){
        $winner = 2;
    } else if ($scorePlayer1[2] > $scorePlayer2[2]){
        $winner = 1;
    } else if ($scorePlayer1[2] < $scorePlayer2[2]){
        $winner = 2;
    } else {$winner = 0;}
    return $winner;
}

///////////////////////////END OF FUNCTIONS///////////////////////////

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

// Get Scores for player 1 and player 2
$resultsPlayer1 = $this->model->getResults(1);
$resultsPlayer2 = $this->model->getResults(2);

// reset win counters
$countP0 = $countP1 = $countP2 = 0;
$scoreList[] = 0;


// Get score for each hand
for ($a = 0; $a < count($resultsPlayer1); $a++ ){
    $scorePlayer1 = getScore($resultsPlayer1[$a]);
    $scoreList[] = $scorePlayer1[0];
    echo "<br>Score is $scorePlayer1[0], $scorePlayer1[1], $scorePlayer1[2]<br>";
    $scorePlayer2 = getScore($resultsPlayer2[$a]);
    $scoreList[] = $scorePlayer2[0];
    echo "<br>Score is $scorePlayer2[0], $scorePlayer2[1], $scorePlayer2[2]<br>";
    $winner = gameWinner($scorePlayer1, $scorePlayer2);
    echo "Winner is player $winner<br><br>";
// count wins
if ($winner == 1){
    $countP1++;
} else if ($winner == 2){
    $countP2++;
} else {$countP0++;}
}
echo "Player1: $countP1 Player2: $countP2 Draw: $countP0<br><br>";

$RF  = count( array_keys( $scoreList, "1" ));
$SF  = count( array_keys( $scoreList, "2" ));
$FK  = count( array_keys( $scoreList, "3" ));
$FH  = count( array_keys( $scoreList, "4" ));
$FL  = count( array_keys( $scoreList, "5" ));
$ST  = count( array_keys( $scoreList, "6" ));
$TK  = count( array_keys( $scoreList, "7" ));
$TP  = count( array_keys( $scoreList, "8" ));
$OP  = count( array_keys( $scoreList, "9" ));
$HC  = count( array_keys( $scoreList, "10" ));

echo "<br>Royal Flush      : $RF";
echo "<br>Straight Flush   : $SF";
echo "<br>Four of a Kind   : $FK";
echo "<br>Full House       : $FH";
echo "<br>Flush            : $FL";
echo "<br>Straight         : $ST";
echo "<br>Three of a Kind  : $TK";
echo "<br>Two Pair         : $TP";
echo "<br>One Pair         : $OP";
echo "<br>High Card        : $HC";
?>

<!--If file has been uploaded, show "See Results" button
Calls "results" if pressed-->
<form name="uploadForm" id="uploadForm" action="index.php?upload" method="POST">
    <button type="submit" >Upload another file</button>
</form>
<?php 

// if user is logged in, show logout button
// calls logout when button is pressed  
if (isset($_SESSION['adminUser'])){?>
    <form name="logoutForm" id="logoutForm" action="index.php?logout" method="POST">
        <button type="submit">Logout</button>
    </form>
<?php }