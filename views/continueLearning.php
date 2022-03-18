<?php 
session_start();

include('heading.php');
include('../models/DBConnect.php');
include('../models/DBFunctions.php');

$categories = GetCategories();


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
                <h1 class="my-auto">Continue Learning</h1>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mt-5 mx-auto"> 
            <div class="row">
                <h2>Available Categories</h2>         
                <div class="category-wrapper text-center col-12">                
                    <!-- Loop through avilable categories -->
                    <?php foreach($categories as $category): ?>
                        <?php $deckCount = GetCategoryDeckCount($category['CategoryID']);?>
                        <a href="categories_decks.php?categoryID=<?php echo $category['CategoryID']; ?>" alt="<?php echo $category['CategoryName']; ?> Category" class="category-option">
                            <div class="row">
                                <div class="col-6 my-auto p-0 m-0">
                                    <img src="../images/<?php echo $category['CategoryImage']; ?>" alt="<?php echo $category['CategoryName']; ?> Category" class="img-fluid">
                                </div>
                                <div class="col-6 my-auto p-0 m-0">
                                    <p>Decks: <?php echo $deckCount['count']; ?></p>
                                </div>
                            </div>                        
                        </a>
                        <hr>
                    <?php endforeach; ?>
                     <!-- END Loop -->

                     
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');?>