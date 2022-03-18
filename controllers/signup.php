<?php
    session_start();
    include_once('../models/DBConnect.php');
    include_once('../models/DBFunctions.php');
    include_once('../views/signup.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['email']) || empty($_POST['userName']) || empty($_POST['password']) || empty($_POST['repeatPassword'])) {
            $_SESSION['signUpErrorMessage'] = 'Please fill out all the fields in the form.';
            header('Location: ./signUp.php');
            exit();
        }

        if ($_POST['password'] !== $_POST['repeatPassword']) {
            $_SESSION['signUpErrorMessage'] = 'The entered passwords do not match.';

            header('Location: ./signUp.php');
            exit();
        }

        if (checkIfUserExists($_POST['email']) == true) {
            $_SESSION['signUpErrorMessage'] = 'There is already a user registered with that email address.';
            header('Location: ./signUp.php');
            exit();
        }

        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $userName = trim(filter_var($_POST['userName'], FILTER_SANITIZE_STRING));
        $password = trim(password_hash(filter_var($_POST['password'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT));

        signUp($email, $userName, $password);

        header('Location: ./login.php');
        $_SESSION['signupSuccess'] = 'Account successfully created!';
        exit();
    }
?>
<?php include('../views/footer.php');?>
