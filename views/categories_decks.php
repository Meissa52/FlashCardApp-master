<?php 

session_start();
include('heading.php');
include('../models/DBConnect.php');
include('../models/DBFunctions.php');

if(isset($_GET['categoryID'])){
	$id = $_GET['categoryID'];
}

$decks = GetCategorysDecks($id);
$categoryName = GetCategoryName($id);


?>
<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-12 header-categories">
            <div class="col-12 text-left">
                <a class="navigation-btn" id="navigation-btn">
                    <img src="../images/hamburg.png" alt="Navigation Menu">
                </a>
            </div>     
            <div class="row h-100 m-0 p-0">                         
                <h1 class="my-auto">Available Decks from <?php echo $categoryName['CategoryName']; ?></h1>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mt-5 mx-auto"> 
            <div class="row">    
                
            <!-- Loop through deck wrapper -->
            <?php if(count($decks) > 0): ?>
                <?php foreach($decks as $deck): ?>
                    <?php $cardCount = GetDecksCardCount($deck['DeckID']); ?>
                        <div class="col-12 deck-wrapper mb-3">
                            <a href="flashcardsQuiz.php?DeckID=<?php echo $deck['DeckID']; ?>" id="">
                                <div class="deck-title row">
                                    <h2 class="col-12"><?php echo $deck['DeckName']; ?></h2>
                                </div>
                                <div class="deck-body">
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <p>
                                            By: <?php echo $deck['UserName']; ?>
                                            </p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p>
                                            Cards: <?php echo $cardCount['count']; ?>
                                            </p>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <p>
                                            <?php echo $deck['DeckDesc']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No decks found.</p>
            <?php endif; ?>

            
            
        </div>
    </div>
</div>

<?php include('footer.php');?>