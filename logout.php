<?php
require_once "assets/data/header.php";
ini_set('display_errors', 1);

$db = Carbase_db::getCarbaseInstance();
$db->closeConnection();
session_unset();
header('Location: index.php');
