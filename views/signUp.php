<?php include('heading.php');?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 header-login">
            <div class="row h-100 m-0 p-0">                
                <h1 class="my-auto">Sign Up</h1>
            </div>
        </div>
        <div class="col-sm-8 col-md-6 mt-5 mx-auto">
        <?php
            if (isset($_SESSION['signUpErrorMessage'])) {
            echo '<p class="text-danger">' . $_SESSION['signUpErrorMessage'] . '</p>';
            unset($_SESSION['signUpErrorMessage']);
            }
        ?>
            <form action="./signup.php" method="post">
                <fieldset>
                    <div class="row">
                        <legend class="sr-only">Create an account</legend>
                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Username</label>
                            <input type="text" name="userName" id="" class="input-field">
                        </div>
                        
                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Email</label>
                            <input type="email" id="" name="email" class="input-field">
                        </div>                   

                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Password</label>
                            <input type="password" id="" name="password" class="input-field">
                        </div>  

                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Confirm Password</label>
                            <input type="password" id="" name="repeatPassword" class="input-field">
                        </div>  
                        <input type="submit" id="" class="secondary-btn" value="Sign Up"/>
                    </div>
                </fieldset>                
            </form>
        </div>
    </div>
</div>
<?php include('footer.php');?>