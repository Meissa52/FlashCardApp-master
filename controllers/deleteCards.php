<?php

$cardID = trim(filter_input(INPUT_POST, 'card-id', FILTER_SANITIZE_STRING));



if (empty($cardID)){
    $message = "Cannot Delete Card!";
	$color = "red-text";
    header('Location: addCards.php');
}

else {
	require_once('dbConnection.php');
	
	$statement = $db->prepare('DELETE FROM cards WHERE CardID = :cardid');
	
	$statement->bindValue(':cardid',$CardID);
    
	$statement->execute();

	$message = "Card Successfully Deleted!";
	$color = "green-text";
	header('Location: addCards.php');

}

?>

