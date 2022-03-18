<?php 
    session_start();
    include('heading.php');
    include('../models/DBConnect.php');
    include('../models/DBFunctions.php');

    if (!isset($_SESSION['signedInEmail'])){
        header("Location: ../controllers/login.php");
    }

    if(!isset($_GET['DeckID'])){
        exit();
    }
    else{
        $deckID = $_GET['DeckID'];
    }

    $deckName = GetDeckByID($deckID)['DeckName'];

    $check = false;
    $cards = GetDecksCards($deckID);
    $users = GetDecksUsers($deckID);
    $loggedIn = GetUserByEmail($_SESSION['signedInEmail']);
    foreach($users as $user){
        if($user['UserFK'] == $loggedIn){
            $check = true;
        }
    }

    $admin = false;
    if(CheckRole($_SESSION['signedInEmail'])){
        $admin = true;
    }  

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
                <!-- Use Echo to get the name of which deck is being used -->
                <h1 class="my-auto"><?php echo $deckName ?></h1>
            </div>
        </div>

        <div class="col-sm-8 col-md-6 mt-5 mx-auto">
            <div class="col-12">
                <?php if(count($cards) > 0): ?>
                    <?php $counter=1;?>
                    <?php foreach($cards as $card): ?>
                        <?php if($counter==1):?>
                            <div class="card-content row h-100">
                                <div class="flip-content col-12 my-auto mx-auto">
                                    <p class="center">
                                        <?php echo $card['Side1']; ?>
                                    </p>
                                </div>
                                <div class="flip-content col-12 my-auto mx-auto dis-none">
                                    <p class="center">
                                        <?php echo $card['Side2']; ?>
                                    </p>
                                </div>
                        </div>
                            <?php $counter="stop"; ?>
                        <?php else: ?>
                            <div class="card-content row h-100 dis-none">
                                <div class="flip-content col-12 my-auto mx-auto">
                                    <p class="center">
                                        <?php echo $card['Side1']; ?>
                                    </p>
                                </div>
                                <div class="flip-content col-12 my-auto mx-auto">
                                    <p class="center">
                                        <?php echo $card['Side2']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>There are no cards in this deck.</p>
                <?php endif; ?>

                <div class="row btn-wrapper">
                    <div class="col-12">
                        <a class="secondary-btn" id="flip-button">Flip Card</a>
                    </div>
                </div>

                <div class="row btn-wrapper">
                    <div class="col-6 px-2">
                        <a class="action-btn" id="prev-button">Prev</a>
                    </div>
                    <div class="col-6 px-2">
                        <a class="action-btn" id="next-button">Next</a>
                    </div>
                </div>
                <?php if(!$check): ?>
                    <div class="row btn-wrapper">
                        <div class="col-6 px-2">
                            <a alt="Add deck to collection" href="../controllers/SubscribeDeck?DeckID=<?php echo $deckID ?>">Add Deck to yours.</a>
                        </div>                     
                    </div>
                <?php endif; ?>
                <?php if($admin): ?>
                    <div class="row btn-wrapper">
                        <div class="col-6 px-2">
                            <a alt="Delete this deck" href="../controllers/deleteDeck?DeckID=<?php echo $deckID ?>">Delete Deck</a>
                        </div>                     
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../js/cardAnimations.js"></script>
<?php include('footer.php');?>
