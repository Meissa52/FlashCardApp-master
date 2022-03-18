<?php

	session_start();
	include_once('../models/DBConnect.php');
	include_once('../models/DBFunctions.php');

	if(isset($_GET['DeckID'])){
		$deckID = $_GET['DeckID'];
		include_once('../views/addCards.php');
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$deckID = trim(filter_input(INPUT_POST, 'deck-id', FILTER_SANITIZE_STRING));
		$cardFront = trim(filter_input(INPUT_POST, 'front-card', FILTER_SANITIZE_STRING));
		$cardBack = trim(filter_input(INPUT_POST, 'back-card', FILTER_SANITIZE_STRING));

		if (empty($cardFront) || empty($cardBack) || empty($deckID)){
			$_SESSION['createCardErrorMessage'] = 'Please fill out a front and back for the card.';
		    header('Location: ./createCards.php?DeckID=' . $deckID);
		    exit();
		}

		else {		
			AddCard($deckID, $cardFront, $cardBack);
			$_SESSION['createCardSuccessMessage'] = 'Card successfully created.';
			header('Location: ./createCards.php?DeckID=' . $deckID);
		}
	}
?>