<?php
require_once "Config.php";
require_once "carbase_db.php";

session_start();
 $GLOBALS['db'] = carbase_db::getCarbaseInstance();
function checkLogin($name, $pass) {
   
    $passCrypt = $GLOBALS['db']->getPass($name);
    if (password_verify($pass, $passCrypt)) {
        $_SESSION['username'] = $name;
        $_SESSION['loggedIn'] = true;
        return true;
    }else {
        return false;
    }
}
function registerUser($username, $password) {
    $success = false;
    
    if($_POST['passphrase'] == $_POST['passphrase2']){
        if(strlen($password) >= 8 && strpos($password, ' ')) {
    	$passCrypt = password_hash($password, PASSWORD_BCRYPT);
        $success = $GLOBALS['db']->registerUser($username, $passCrypt);
    }else{
    	echo "<p>Register failed. Please check if your passphrase is at least 8 characters and contains spaces.</p>".
        "<a href='register.php'>Try again</a>";
	}
    } else{
        echo "<p>Register failed. Your phrases didn't match!</p>".
        "<a href='register.php'>Try again</a>";
    }
    
    if($success) {
    	mkdir("upload/".strtolower($username));
	}
    return $success;
}



//submit pictures functions

function checkFile($file){
    if($file['error'] !== 0) {
        return false;
    }
    
    $allowedFileTypes = array('image/jpeg','image/png','image/gif','image/bmp','text/plain');
    $maxFileSize = 2000000000;  //NOTE php file size? (=> this is 2 GB)
    $targetFile = "upload/".$_SESSION['username']."/".$file['name'];
    $uploadOk = 0;
    $amountOfChecks = 3;
    //NOTE Check if file exists already.
    if(!file_exists($targetFile)) {
        $uploadOk++;
    }
    //NOTE Check if filesize is OK.
    if($file['size'] <= $maxFileSize) {
        $uploadOk++;
    }
    //NOTE Check if the filetype is OK.
    foreach($allowedFileTypes as $allowedType) {
        if($file['type'] == $allowedType) {
            $uploadOk++;
            break;
        }
    }
    return ($uploadOk == $amountOfChecks);
}
function saveFile($file){
    $success = checkFile($file);
	$targetDir = "upload/".strtolower($_SESSION['username'])."/";
    
    if($success) {
        
		$success = move_uploaded_file($file['tmp_name'], $targetDir . $file['name']);
        
        if($success){
            $GLOBALS['db']->storeFile($_SESSION['username'], $file['name'], $targetDir);
        }
        
	}
    return $success;
}
