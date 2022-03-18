<?php 
    session_start();
    include('views/heading2.php');
?>
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-12 my-5">
            <img src="images/alfred-state-a.png" class="img-fluid alfred-logo" alt="Alfred State Logo">
            <h1>Flashcard Application</h1>
            <?php
                if(isset($_SESSION['logoutMessage'])) {
                    echo '<p>' . $_SESSION['logoutMessage'] . '</p>';
                    unset($_SESSION['logoutMessage']);
                }
            ?>
        </div>
        <div class="col-sm-8 col-md-6 col-lg-4 mt-5 mx-auto">
            <a href="controllers/login.php" class="primary-btn">Login</a>
            <a href="controllers/signUp.php" class="primary-btn">Sign Up</a>
        </div>
    </div>
</div>
<?php include('views/footer.php');?>
