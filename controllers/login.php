<?php
    session_start();
    include_once('../models/DBConnect.php');
    include_once('../models/DBFunctions.php');
    include_once('../views/login.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['loginErrorMessage'] = 'Please enter both an email and password';
            header('Location: ./login.php');
            exit();
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        login($email, $password);

        header('Location: ../views/myDecks.php');
        exit();
    }
?>
<?php include('../views/footer.php');?>