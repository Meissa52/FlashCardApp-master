
<?php 
    include('heading.php');
    $categories = GetCategories();
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
                <?php if(isset($deckID)): ?>
                    <h1 class="my-auto">Manage Deck</h1>
                <?php else: ?>                
                    <h1 class="my-auto">New Deck</h1>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-8 col-md-6 mt-5 mx-auto">
            <?php
                if (isset($_SESSION['editDeckErrorMessage'])) {
                    echo '<p class="text-danger">' . $_SESSION['editDeckErrorMessage'] . '</p>';
                    unset($_SESSION['editDeckErrorMessage']);
                }
            ?>
            <?php if(isset($deckID)): ?>
                <form action="./editDeck.php" method="post">
                <input type="hidden" name="deckID" value="<?php echo $deck['DeckID']; ?>">
            <?php else: ?>
                <form action="./addDeck.php" method="post">
            <?php endif;?>
                    <div class="row">
                        
                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Deck Name</label>
                            <?php if(isset($deckID)): ?>
                                <input type="text" class="input-field" name="deck-name" value="<?php echo $deck['DeckName']; ?>" />
                            <?php else: ?>
                                <input type="text" class="input-field" name="deck-name" />
                            <?php endif;?>
                        </div>

                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Category</label>
                            <select name="categories" class="input-field">
                                <?php foreach($categories as $category): ?>
                                        <?php if(isset($deckID) && $deck['CategoryFK'] == $category['CategoryID']): ?>
                                            <option value="<?php echo $category['CategoryID']; ?>" selected><?php echo $category['CategoryName']; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $category['CategoryID']; ?>"><?php echo $category['CategoryName']; ?></option>
                                        <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12 px-2">
                            <label for="" class="input-label">Description</label>
                            <?php if(isset($deckID)): ?>
                                <textarea type="text" class="textarea-field" name="description"><?php echo $deck['DeckDesc']; ?></textarea>
                            <?php else: ?>
                                <textarea type="text" class="textarea-field" name="description"></textarea>
                            <?php endif;?>
                        </div>

                        <label for="" >Want to make this deck public?</label>

                        <?php if(isset($deckID) && $deck['Public'] == true): ?>
                            <input type="checkbox" name="if-public" checked="true" />
                        <?php else: ?>
                            <input type="checkbox" name="if-public" />
                        <?php endif; ?>

                        <?php if(isset($deckID)): ?>
                            <input type="submit" id="" class="action-btn" value="Submit Changes" />
                            <a href="../controllers/createCards.php?DeckID=<?php echo $deckID; ?>" class="secondary-btn">Add Cards</a>
                        <?php else: ?>                
                            <input type="submit" id="" class="action-btn" value="Add Cards" />
                        <?php endif; ?>
                        
                    </div>
                </form>
            
        </div>
    </div>
</div>
<?php include('footer.php');?>
