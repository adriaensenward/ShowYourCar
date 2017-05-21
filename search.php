<?php
    require_once "assets/data/header.php";
if(isset($_SESSION['loggedIn'])){
?>
    <div data-role="main" class="ui-content">
        <form method="get">
            <label for="search">Search a car or a person:</label>
            <input type="search" name="keyword" id="search" value="" />
        </form>

        <?php
        showSearchresults();
        ?>
    </div>
    </div>
    <?php
} else{
    header('Location: index.php');
}
