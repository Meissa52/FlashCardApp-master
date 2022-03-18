<?php
session_start();

include('../models/DBConnect.php');
include('../models/DBFunctions.php');

if(!isset($_GET['DeckID'])){
	exit();
}
else{
	$deckID = $_GET['DeckID'];
}

RemoveDeckFromCollection($deckID);

header("Location: ../views/myDecks.php");




?>