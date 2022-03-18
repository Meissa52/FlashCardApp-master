<!doctype html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/animations.css">
		<link rel="stylesheet" href="../css/slideOut.css">
		<title>Flashcard Application</title>
  	</head>
  <body>
	<div class="container-fluid container-img navbackgrounddiv dis-none" id="slide-out-action">
		<div class="row text-center">
			<div class="col-12 my-2 p-0">
				<div class="row m-0 p-0">
					<div class="col-6 text-left p-3">
						<form action="../controllers/logout.php">
							<input type="submit" id="" class="logout-btn" value="Logout">
						</form>
					</div>
					<div class="col-6 text-right p-3">
						<button class="close-btn" id="close-btn">X</button>
					</div>
				</div>
			</div>
			<div class="col-12 my-3">
				<img src="../images/alfred-state-a.png" class="img-fluid alfred-logo" alt="Alfred State Logo">
				<h1>Flashcard Application Menu</h1>            
			</div>
			<div class="col-sm-8 col-md-6 col-lg-4 mt-5 mx-auto">
				<a href="../views/continueLearning.php" class="primary-btn">Continue Learning</a>
	            <a href="../controllers/addDeck.php" class="primary-btn">Create a New Deck</a>
	            <a href="../views/mydecks.php" class="primary-btn">My Decks</a>
	            <a href="../controllers/random.php" class="primary-btn">Random Deck</a>
			</div>
		</div>
	</div>
