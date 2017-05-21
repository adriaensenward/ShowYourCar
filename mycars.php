<?php
    require_once "assets/data/header.php";

if(isset($_SESSION['loggedIn'])){
    showCars($_SESSION['username']);
} else{
    header('Location: index.php');
}
