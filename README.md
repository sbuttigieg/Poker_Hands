# Poker Hands

A program to analyse poker hands and determine the winner between 2 players

## Getting started

Run the SQL file Poker_Hands.sql that is located in the Model folder
This will create the 'pokerhands' database with 2 tables: - 'results' and 'admin'
The database is referenced in the Model/DB.php class as a PDO with the following parameters:
	"mysql:host=localhost;dbname=pokerhands", "root", "");

Login to the website is done through the following: -
	Username: admin
	Password: admin

Once logged in, the upload page is shown.
Only text files are allowed. Trying to upload any filetype will give an error message.
Once a text file is uploaded, you can follow through to see the results.
Results for both players are displayed in the results page.
The occurrence of rankings is also displayed.

Before saving the hands in the database, the text files are checked for the following:
	- that 10 cards in each row
	- that cards consist of 2 characters, example '2H'
	- that cards have a suit that is one of 'S', 'H', 'D', 'C'
	- that cards have a value that is one of '2 to 9', 'T', 'J', 'Q', 'K', 'A'

In the Hands folder there are text files that test for these errors.

In the Hands folder there is also a text file that has several combinations of hands to test
the algorithm functionality.

In the Hands folder there is the original "hands.txt" file sent with this assignment.
There is also a shortened version "hands60.txt" that has the first 60 rows instead of 1000 rows.

In the main folder there is a flowchart for the main flow of the code and one for the result algorithm.

Note:
On my system that uses XAMPP, loading the "hands.txt" with 1000 rows into the database is quite slow.



