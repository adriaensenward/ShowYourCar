<?php
    
    require_once "assets/data/header.php";
ini_set('display_errors', 1);
if(isset($_SESSION['loggedIn'])){
    ?>
    <div data-role="main" class="ui-content">
        <p>Welcome,
            <?php echo $_SESSION['username'] ?>!</p>
        <div class="ui-grid-b recent">

            <p>Recently added</p>
            <?php 
        showLastImages();
            ?>
        </div>

    </div>


    </div>
    <?php
} else{
    header('Location: index.php');
}

    
    require_once "assets/data/footer.php";
?>
