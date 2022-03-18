<?php
	session_start();
	include_once('../models/DBConnect.php');
    include_once('../models/DBFunctions.php');

	if(isset($_GET['DeckID'])){
		$deckID = $_GET['DeckID'];
		$deck = GetDeckByID($deckID);

		$loggedInUserId = GetUserByEmail($_SESSION['signedInEmail']);
		$deckOwnerUserId = GetUserIdByDeck($deckID);
	
		if ($loggedInUserId !== $deckOwnerUserId) {
			$_SESSION['editDecksMessage'] = 'You do not have persmission to make changes to that deck.';
			header('Location: ../views/myDecks.php');
			exit();
		}

    	include_once('../views/newDeck.php');
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$deckID = trim(filter_input(INPUT_POST, 'deckID', FILTER_VALIDATE_INT));
		$deckName = trim(filter_input(INPUT_POST, 'deck-name', FILTER_SANITIZE_STRING));
		$description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
		$categoryID = trim(filter_input(INPUT_POST, 'categories', FILTER_VALIDATE_INT));


		if(empty($deckName) || empty($description))
		{
			$_SESSION['editDeckErrorMessage'] = 'The deck must have a name and description';
			header("Location: ./editDeck.php?DeckID=" . $deckID);
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

			EditDeck($deckID, $deckName, $description, $ifPublic, $categoryID);

			$_SESSION['editDecksMessage'] = 'Deck changes successfully saved.';
			header("Location: ../views/myDecks.php");
			exit();
		}
	}	
?>