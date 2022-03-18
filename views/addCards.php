<?php include('heading.php');?>
<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-12 header-login">            
            <div class="col-12 text-left">
                <a class="navigation-btn" id="navigation-btn">
                    <img src="../images/hamburg.png" alt="Navigation Menu">
                </a>
            </div>   
            <div class="row h-100 m-0 p-0">                
                <h1 class="my-auto">Add Cards</h1>
            </div>
        </div>
        <div class="col-sm-8 col-md-6 mt-5 mx-auto">
            <?php
                if (isset($_SESSION['createCardErrorMessage'])) {
                    echo '<p class="text-danger">' . $_SESSION['createCardErrorMessage'] . '</p>';
                    unset($_SESSION['createCardErrorMessage']);
                }

                if (isset($_SESSION['createCardSuccessMessage'])) {
                    echo '<p class="text-success">' . $_SESSION['createCardSuccessMessage'] . '</p>';
                    unset($_SESSION['createCardSuccessMessage']);
                }
            ?>
            <form action="./createCards.php" method="post">
            <input type="hidden" name="deck-id" value="<?php echo $deckID; ?>">
            <div class="col-md-12 px-2">
            <label for="" class="input-label">Front of Card</label>
            <textarea type="text" class="textarea-field" name="front-card"></textarea>
            </div>

            <div class="col-md-12 px-2">
            <label for="" class="input-label">Back of Card</label>
            <textarea type="text" class="textarea-field" name="back-card"></textarea>
            </div>

            <input type="submit" id="" class="secondary-btn" value="Add Card">
            <a href="editDeck.php?DeckID=<?php echo $deckID; ?>" class="action-btn">Complete Deck</a>
          </form>
        </div>
    </div>
</div>
<?php include('footer.php');?>
