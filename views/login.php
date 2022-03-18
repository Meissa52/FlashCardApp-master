<?php include('../views/heading.php');?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 header-login">
            <div class="row h-100 m-0 p-0">                
                <h1 class="my-auto">Login</h1>
            </div>
        </div>
        <div class="col-sm-8 col-md-6 mt-5 mx-auto">
        <?php
            if (isset($_SESSION['loginErrorMessage'])) {
                echo '<p class="text-danger">' . $_SESSION['loginErrorMessage'] . '</p>';
                unset($_SESSION['loginErrorMessage']);
            }

            if (isset($_SESSION['signupSuccess'])) {
                echo '<p class="text-success">' . $_SESSION['signupSuccess'] . '</p>';
                unset($_SESSION['signupSuccess']);
            }
        ?>
            <form action="" method="post">
                <fieldset>
                    <div class="row">
                        <legend class="sr-only">Login to account</legend>
                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Email</label>
                            <input type="text" id="" name="email" class="input-field">
                        </div>

                        <div class="col-md-6 px-2">
                            <label for="" class="input-label">Password</label>
                            <input type="password" id="" name="password" class="input-field">
                        </div>  
                        <input type="submit" id="" class="secondary-btn" value="Login">
                    </div>
                </fieldset>                
            </form>
        </div>
    </div>
</div>