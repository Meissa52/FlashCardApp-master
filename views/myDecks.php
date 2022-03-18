<?php 
    session_start();
    include('heading.php');
    include('../models/DBConnect.php');
    include('../models/DBFunctions.php');

    if (!isset($_SESSION['signedInEmail'])){
        header("Location: ../controllers/login.php");
    }
    
    $decks = GetDecksByUser($_SESSION['signedInEmail']);
?>
<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-12 header-login">
            <div class="col-12 text-left">
                <a class="navigation-btn" id="navigation-btn">
                    <img src="../images/hamburg.png" alt="Navigation Menu">
                </a>
            </div>   
            <div class="row h-100 m-0 p-0">                
                <h1 class="my-auto">My Decks</h1>
            </div>
        </div>
        <div class="col-sm-8 col-md-6 mt-5 mx-auto">
            <?php
                if (isset($_SESSION['editDecksMessage'])) {
                    echo '<p>' . ($_SESSION['editDecksMessage']) . '</p>';
                    unset($_SESSION['editDecksMessage']);
                }
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Cards</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($decks) > 0): ?>
                        <?php foreach($decks as $deck): ?>
                            <?php $cardCount = GetDecksCardCount($deck['DeckID']); ?>                       
                                <tr>
                                    <td scope="col"><?php echo $deck['CategoryName']; ?></td>
                                    <td scope="col"><?php echo $deck['DeckName']; ?></td>
                                    <td scope="col"><?php echo $deck['DeckDesc']; ?></td>
                                    <td scope="col"><?php echo $cardCount['count']; ?></td>
                                    <td scope="col"><a href="../views/flashcardsQuiz.php?DeckID=<?php echo $deck['DeckID']; ?>" alt="View <?php echo $deck['DeckName']; ?>" >View Cards</a></td>
                                    
                                        <?php if($deck['Creator']): ?>
                                            <td scope="col">
                                                <a href="../controllers/editDeck.php?DeckID=<?php echo $deck['DeckID']; ?>" alt="Manage <?php echo $deck['DeckName']; ?>" >Manage Deck</a>
                                            </td>
                                            <td scope="col">
                                                <a href="../controllers/deleteDeck.php?DeckID=<?php echo $deck['DeckID']; ?>" alt="Delete <?php echo $deck['DeckName']; ?>" onclick="return confirm('Are you sure you want to delete this record?.');">Delete Deck</a>
                                            </td>
                                        <?php else: ?>
                                            <td scope="col"></td>
                                            <td scope="col"><a href="../controllers/removeDeck.php?DeckID=<?php echo $deck['DeckID']; ?>" alt="Remove <?php echo $deck['DeckName']; ?>" >Remove Deck</td>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No decks found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php');?>