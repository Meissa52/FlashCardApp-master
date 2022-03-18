<?php 

session_start();
include('../views/heading.php');
include('../models/DBConnect.php');
include('../models/DBFunctions.php');

$redirect = RandomDeck();

header('Location: ' . $redirect);
