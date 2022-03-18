<?php
    session_start();
    unset($_SESSION['signedInEmail']);
    $_SESSION['logoutMessage'] = 'You have been successfully logged out.';
    header('Location: ../index.php');
    exit();
?>