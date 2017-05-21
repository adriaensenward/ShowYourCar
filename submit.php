<?php

    require_once "assets/data/header.php";
ini_set('display_errors', 1);


if(isset($_SESSION['loggedIn'])){

        ?>
    <form data-ajax="false" action="fileUpload.php" method="POST" enctype='multipart/form-data'>
        Select image to upload:
        <input type="file" name="file">
        <input type="submit" value="Upload Image" name="submit">

    </form>
    <?php
} else{
    header('Location: index.php');
}
