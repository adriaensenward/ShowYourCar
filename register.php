<?php
    require_once "assets/data/header2.php";

$httpVerb = $_SERVER['REQUEST_METHOD'];
switch($httpVerb) {
	case "GET":
		showRegister();
		break;
	case "POST":
		$success = registerUser($_POST['username'],$_POST['passphrase']);
		if($success) {
			//TODO User registered
			echo "Succesfull registration!";
		}
		break;
	default:
		break;
}
