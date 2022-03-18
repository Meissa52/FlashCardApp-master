<?php
	session_start();

	include('../models/DBConnect.php');
	include('../models/DBFunctions.php');

	if(!isset($_GET['DeckID'])){
		$_SESSION['editDecksMessage'] = 'There was an issue deleteing your deck.';
		header("Location: ../views/myDecks.php");
		exit();
	}
	else{
		$deckID = $_GET['DeckID'];
	}

	if(CheckDeleteDeckPermissions($deckID)){
		DeleteDeck($deckID);
		$_SESSION['editDecksMessage'] = 'Deck successfully deleted.';		
	}

	header("Location: ../views/myDecks.php");

?>