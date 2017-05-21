<?php
require_once "assets/data/header2.php";
ini_set('display_errors', 1);if(!isset($_SESSION["username"])){
    if(isset($_POST['username']) || isset($_POST['passphrase'])){
    if (checkLogin($_POST['username'],$_POST['passphrase'])){
        header('Location: dashboard.php');
        die();
    }else{
        showLogin();
    } 
} else{
    showLogin();
}

} else{
    header('Location: dashboard.php');
    die();
}
require_once "assets/data/footer.php";
