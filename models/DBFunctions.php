<?php 


////// Category Functions ///////

function GetCategories(){

	global $db;

	$query = $db->prepare("SELECT CategoryID, CategoryName, CategoryImage FROM categories");
	$query->execute();

	$result = $query->fetchall();

	return $result;

}

function GetCategoryName($CategoryID){

	global $db;

	$query = $db->prepare("SELECT CategoryName FROM categories					
							WHERE CategoryID = :CategoryID ");

	$query->bindParam(":CategoryID", $CategoryID);
	$query->execute();

	$result = $query->fetch();

	return $result;
}

function GetCategoryDeckCount($CategoryID){

	global $db;

	$query = $db->prepare("SELECT COUNT(DeckID) as count FROM decks					
							INNER JOIN deckscategories ON deckscategories.DeckFK = decks.DeckID
							 WHERE decks.Public = true AND deckscategories.CategoryFK = :CategoryID ");

	$query->bindParam(":CategoryID", $CategoryID);
	$query->execute();

	$result = $query->fetch();

	return $result;

}

function GetCategorysDecks($CategoryID){

	global $db;

	$query = $db->prepare("SELECT DeckName, DeckDesc, DeckID, users.UserName FROM decks
							INNER JOIN deckscategories ON decks.DeckID = deckscategories.DeckFK
                            LEFT JOIN userdecks ON decks.DeckID = userdecks.DeckFK
                    		INNER JOIN users ON userdecks.UserFK = users.UserID
							WHERE decks.Public = true AND deckscategories.CategoryFK = :CategoryID AND userdecks.Creator = true
							ORDER BY DeckName, users.UserName ");
	$query->bindParam(":CategoryID", $CategoryID);
	$query->execute();

	$result = $query->fetchall();

	return $result;

}

function CreateCategory($CategoryName, $CategoryImage){

	global $db;

	$query = $db->prepare("INSERT INTO categories (CategoryName, CategoryImage) VALUES (:CategoryName, :CategoryImage)");

	$query->bindParam(":CategoryName", $CategoryName);
	$query->bindParam(":CategoryImage", $CategoryImage);
	$query->execute();

}

////// Deck Functions ///////


function GetDecksCardCount($DeckID){

	global $db;

	$query = $db->prepare("SELECT COUNT(CardID) as count FROM cards					
							 WHERE cards.DeckFK = :DeckID ");

	$query->bindParam(":DeckID", $DeckID);
	$query->execute();

	$result = $query->fetch();

	return $result;

}

function AddDeck($description, $deckName, $ifPublic, $categoryDeck){

	global $db;

	$deck = $db->prepare("INSERT INTO decks (DeckDesc, DeckName, Public) VALUES (:DeckDesc, :DeckName, :Public)");

	$deck->bindParam(":DeckDesc", $description);
	$deck->bindParam(":DeckName", $deckName);
	$deck->bindParam(":Public", $ifPublic);
	$deck->execute();

	$deckID = $db->prepare("SELECT LAST_INSERT_ID() FROM decks");
	$deckID->execute();
	$deckID->fetch();
	
	foreach($deckID as $decks)
	{
		$theID = $decks[0];
	}

	$category = $db->prepare("INSERT INTO deckscategories (CategoryFK, DeckFK) VALUES (:categoryfk, :deckfk)");
	$category->bindParam(":categoryfk", $categoryDeck);
	$category->bindParam(":deckfk", $theID);
	$category->execute();

	$userID = GetUserByEmail($_SESSION['signedInEmail']);
	$user = $db->prepare("INSERT INTO userdecks (DeckFK, UserFK, Creator) VALUES (:deckfk, :userfk, true)");
	$user->bindParam(":deckfk", $theID);
	$user->bindParam(":userfk", $userID);
	$user->execute();

	return $theID;

}

function GetDecksByUser($Email){

	global $db;

	$query = $db->prepare("SELECT DeckName, DeckDesc, DeckID, Public, userdecks.Creator, categories.CategoryName FROM decks
							INNER JOIN deckscategories ON decks.DeckID = deckscategories.DeckFK
							INNER JOIN categories ON deckscategories.CategoryFK = categories.CategoryID
							INNER JOIN userdecks ON decks.DeckID = userdecks.DeckFK
							INNER JOIN users ON userdecks.UserFK = users.UserID
							WHERE users.Email = :Email 
							ORDER BY Creator DESC");
	$query->bindParam(":Email", $Email);
	$query->execute();

	$result = $query->fetchall();

	return $result;

}

function EditDeck($deckID, $deckName, $description, $ifPublic, $categoryID){

	global $db;

	$deck = $db->prepare("UPDATE decks SET DeckName=:DeckName, DeckDesc = :DeckDesc, Public = :Public WHERE DeckID = :DeckID");

	$deck->bindParam(":DeckID", $deckID);
	$deck->bindParam(":DeckName", $deckName);
	$deck->bindParam(":DeckDesc", $description);
	$deck->bindParam(":Public", $ifPublic);
	$deck->execute();

	$category = $db->prepare("UPDATE deckscategories SET CategoryFK = :CategoryFK WHERE DeckFK = :DeckID");
	$category->bindParam(":DeckID", $deckID);
	$category->bindParam(":CategoryFK", $categoryID);
	$category->execute();
}

function GetDeckByID($DeckID){

	global $db;

	$query = $db->prepare("SELECT DeckName, DeckDesc, DeckID, Public, userdecks.Creator, deckscategories.CategoryFK FROM decks
							INNER JOIN deckscategories ON decks.DeckID = deckscategories.DeckFK							
							INNER JOIN userdecks ON decks.DeckID = userdecks.DeckFK
							WHERE DeckID = :DeckID");
	$query->bindParam(":DeckID", $DeckID);
	$query->execute();

	$result = $query->fetch();

	return $result;

}

function GetDecksUsers($DeckID){

	global $db;

	$query = $db->prepare("SELECT userdecks.UserFK FROM decks
							INNER JOIN userdecks ON decks.DeckID = userdecks.DeckFK								
							WHERE DeckID = :DeckID");
	$query->bindParam(":DeckID", $DeckID);
	$query->execute();

	$result = $query->fetchall();

	return $result;

}

function AddDeckToCollection($DeckID){

	global $db;

	$query = $db->prepare("INSERT INTO userdecks (UserFK, DeckFK) VALUES (:UserFK, :DeckFK)");
	$query->bindParam(":DeckFK", $DeckID);
	$UserFK = GetUserByEmail($_SESSION['signedInEmail']);
	$query->bindParam(":UserFK", $UserFK);
	$query->execute();

}

function RemoveDeckFromCollection($DeckID){

	global $db;

	$query = $db->prepare("DELETE FROM userdecks WHERE DeckFK = :DeckFK AND UserFK = :UserFK");
	$query->bindParam(":DeckFK", $DeckID);
	$UserFK = GetUserByEmail($_SESSION['signedInEmail']);
	$query->bindParam(":UserFK", $UserFK);
	$query->execute();

}

function DeleteDeck($deckID){

	global $db;

	$deck = $db->prepare("DELETE FROM decks WHERE DeckID = :DeckID");

	$deck->bindParam(":DeckID", $deckID);
	

	$deck->execute();
}

function RandomDeck(){
        
        global $db;
        
        $loopCheck=false;
        
        $query = 'SELECT * FROM decks WHERE Public = 1';

        $pubDecksquery = $db->prepare($query);
        
        $pubDecksquery->execute();
        
        $pubDecks = $pubDecksquery->fetchall();
        
        $deckCount = count($pubDecks);
        
        if($deckCount > 0){
            
            $pubDecksArr = array();

            foreach($pubDecks as $pubDeck){
                $pubDecksArr[] = $pubDeck['DeckID'];
            }
            
            $randomID = rand(0, $deckCount - 1);
            
            //return $pubDecksArr[$randomID];
            
            $randomDeck = $pubDecksArr[$randomID];
            
        }
        if(isset($randomDeck)){
            $redirect = "../views/flashcardsQuiz.php?DeckID=" . $randomDeck;
        }else{
            $redirect = "../views/myDecks";
        }
        return $redirect;
    }

///////// User Functions //////

function DeleteUser($UserID){

	global $db;

	$query = $db->prepare("SELECT DeckFK FROM userdecks					
							 WHERE UserFK = :UserFK ");

	$query->bindParam(":UserFK", $UserID);
	$query->execute();

	$result = $query->fetchall();

	foreach($result as $deck){
		DeleteDeck($deck['DeckFK']);
	}

	$query = $db->prepare("DELETE FROM users					
							 WHERE UserID = :UserID");

	$query->bindParam(":UserID", $UserID);
	$query->execute();
}

function GetUserByEmail($email){

	global $db;

	$query = $db->prepare("SELECT UserID FROM users					
							 WHERE Email = :Email ");

	$query->bindParam(":Email", $email);
	$query->execute();

	$result = $query->fetch();

	return $result['UserID'];

}

function login($email, $password) {
	  
  global $db;

  $statement = $db->prepare('SELECT * FROM users WHERE Email = :email OR UserName = :email;');
  $statement->execute(array(':email' => $email));

  $user = $statement->fetch(PDO::FETCH_ASSOC);

  if ($statement->rowCount() == 1) {
      if (password_verify($password, $user['Password'])) {
          $_SESSION['signedInEmail'] = $email;
      } else {
          $_SESSION['loginErrorMessage'] = 'Your username or password is incorrect';
          header('Location: #');
          exit();
      }
  } else {
      $_SESSION['loginErrorMessage'] = 'There was an error while logging you in. Please try again.';
      header('Location: #');
      exit();
  }
}

function logout() {
  unset($_SESSION['signedInEmail']);
}

// validation occurs in the controller, this funciton's only responsibility to insert the sign up 
// data into the database
function signUp($email, $userName, $password) {
	global $db;

    $statement = $db->prepare('INSERT INTO users(RoleFK, Email, UserName, Password) VALUES(:roleFK, :email, :username, :password)');
    $statement->execute(array(':roleFK' => 2, ':email' => $email, ':username' => $userName, ':password' => $password));
}

// returns true if there is already a record containing the entered email address
function checkIfUserExists($email) {
	global $db;
	
    $statement = $db->prepare('SELECT * FROM users WHERE Email = :email');
    $statement->execute(array(':email' => $email));

    if ($statement->rowCount() >= 1) {
        return true;
    } else {
        return false;
    }
}

//////// Card Functions /////

function AddCard($deckID, $cardFront, $cardBack){

	global $db;

	$statement = $db->prepare('INSERT INTO cards (DeckFk,Side1,Side2) VALUES(:deckfk, :side1, :side2);');
	
	$statement->bindValue(':deckfk',$deckID);
	$statement->bindValue(':side1',$cardFront);
    $statement->bindValue(':side2',$cardBack);
    
	$statement->execute();
}

function GetDecksCards($deckID){

	global $db;

	$query = $db->prepare("SELECT Side1, Side2 FROM cards								
							WHERE DeckFK = :DeckID");
	$query->bindParam(":DeckID", $deckID);
	$query->execute();

	$result = $query->fetchall();

	return $result;

}

function GetUserIdByDeck($DeckID){

	global $db;

	$query = $db->prepare("SELECT userdecks.UserFK FROM userdecks
							INNER JOIN decks ON userdecks.DeckFK = decks.DeckID							
							WHERE DeckID = :DeckID");
	$query->bindParam(":DeckID", $DeckID);
	$query->execute();

	// returns an array of 1 item, so grab the first item instead of
	// the entire array
	$result = $query->fetch()[0];

	return $result;

}

//// Permissions Fuctions

function CheckRole($email){

	global $db;

	$query = $db->prepare("SELECT RoleFK FROM users					
							 WHERE Email = :Email ");

	$query->bindParam(":Email", $email);
	$query->execute();

	$result = $query->fetch();

	if($result['RoleFK'] == 1){
		return true;
	}
	else{
		return false;
	}

}

function GetUserEmailByID($userID){

	global $db;

	$query = $db->prepare("SELECT Email FROM users					
							 WHERE UserID = :UserID ");

	$query->bindParam(":UserID", $userID);
	$query->execute();

	$result = $query->fetch();

	return $result['Email'];

}

function CheckDeleteDeckPermissions($deckID){

	global $db;

	$query = $db->prepare("SELECT UserFK FROM userdecks					
							 WHERE DeckFK = :DeckID AND Creator = true ");

	$query->bindParam(":DeckID", $deckID);
	$query->execute();

	$result = $query->fetch();

	if(GetUserEmailByID($result['UserFK']) == $_SESSION['signedInEmail'] || CheckRole($_SESSION['signedInEmail'])){
		return true;
	}
	else{
		return false;
	}

}

?>
