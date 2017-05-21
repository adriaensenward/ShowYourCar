<?php
    require_once "showFuncs.php";
    require_once "doFuncs.php";
    require_once "carbase_db.php";
    require_once "Config.php";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="assets/css/jquery.mobile-1.4.5.min.css">
        <link rel="stylesheet" href="assets/css/style.css">


        <script src="assets/js/jquery-1.11.3.js"></script>
        <script src="assets/js/jquery.mobile-1.4.5.min.js"></script>
        <script src="assets/js/script.js"></script>
    </head>


    <body>
        <div data-role="page">
            <div data-role="header" class="header">
                <p id="headertext">Show your car
                </p>

            </div>
            <div data-role="navbar">
                <ul>
                    <li><a href="dashboard.php" data-icon="home">Home</a></li>
                    <li><a href="search.php" data-icon="search">Search</a></li>
                    <li><a href="profile.php" data-icon="user">Profile</a></li>
                    <li><a href="submit.php" data-icon="plus">Submit</a></li>
                </ul>
            </div>
