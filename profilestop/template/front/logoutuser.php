<?php 
 	session_start();
    $_SESSION = array();
    unset($_SESSION['user']);
    session_destroy();
    header("location: loginregister.php");
    exit;
?>