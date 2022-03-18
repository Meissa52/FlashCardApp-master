<?php
session_start();
    include_once('../models/DBConnect.php');
    include_once('../models/DBFunctions.php');
    

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$deckName = trim(filter_input(INPUT_POST, 'deck-name', FILTER_SANITIZE_STRING));
		$description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
		
		$categoryDeck = $_POST['categories'];

		if(empty($deckName) || empty($description) || empty($categoryDeck))
		{
			$_SESSION['editDeckErrorMessage'] = 'Please fill out all fields and select a category';
			header("Location: ../controllers/addDeck.php");
			exit();
		}
		else
		{
			if(isset($_POST['if-public'])){
				$ifPublic = 1;
			}
			else{
				$ifPublic = 0;
			}			

			$deckID = AddDeck($description, $deckName, $ifPublic, $categoryDeck);		
			
			header("Location: ../controllers/createCards.php?DeckID=" . $deckID);
		}
	}

include_once('../views/newDeck.php');
	
?>
