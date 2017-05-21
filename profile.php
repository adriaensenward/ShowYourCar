<?php
    require_once "assets/data/header.php";
ini_set('display_errors', 1);


    if(isset($_SESSION['loggedIn'])){

        ?>

    <div data-role="main" class="ui-content">

        <div class="ui-grid-a">
            <div class="ui-block-a">
                <img class="ui-grid-a" src="https://media.licdn.com/mpr/mpr/shrinknp_150_150/AAEAAQAAAAAAAAduAAAAJDE4ZGJhNWVjLWZkZDQtNDVmNy04YWMzLWFiNGZjMjBmYjc2Mw.jpg" />
            </div>

            <div class="ui-block-b">
                <p id="name">
                    <?php echo $_SESSION['username']; ?>
                </p>
                <p id="numberoffriends">1 friend</p>
                <a class="ui-btn" id="addfriend">Add friend</a>
            </div>
        </div>

        <a class="ui-btn" href="submit.php">Submit a car
                    </a>
        <a href="mycars.php" name="showmycars" class="ui-btn">
                        Show my cars
                    </a>
        <a class="ui-btn">Settings
                    </a>
        <a class="ui-btn" href="logout.php">Log out
                    </a>

    </div>


    </div>
    <?php
    } else{
        header("Location: index.php");
    }
?>
