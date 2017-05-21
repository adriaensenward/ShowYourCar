<?php

function showLogin() { ?>
    <div data-role="content">
        <div id="landmark-1" data-landmark-id="1">
            <form action="index.php" method="post">
                <div data-role="fieldcontain" class="ui-hide-label">
                    <input type="text" name="username" id="username" placeholder="Username" required autofocus/>
                </div>

                <div data-role="fieldcontain" class="ui-hide-label">
                    <input type="password" name="passphrase" id="passphrase" placeholder="Passphrase" required/>
                </div>
                <a href=register.php>No account yet? Click here!</a>
                <input type="submit" value="Login">
            </form>

        </div>

    </div>
    </div>
    <?php
}

function showRegister()
{
	?>
        <div data-role="main" class="ui-content">
            <form action="register.php" method="post" class="ui-body ui-body-a ui-corner-all">
                <div data-role="fieldcontain">
                    <label for="username">Username:</label>
                    <input type="text" value="" name="username" id="username" />
                </div>
                <div data-role="fieldcontain">
                    <label for="passphrase">Passphrase:</label>
                    <input type="password" name="passphrase" id="passphrase" />
                </div>
                <div data-role="fieldcontain">
                    <label for="passphrase2">Passphrase again:</label>
                    <input type="password" name="passphrase2" id="passphrase2" />
                    <p class="smalltext">Must be at least 8 characters (phrases are way more secure than words, believe me!).</p>
                </div>
                <div><input type="submit" data-theme="b" name="submit" id="submit" value="Register"></div>

            </form>
        </div>

        </div>

        <?php
}
function showSearchResults(){
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
        printf("Search results for:  ".$keyword."</br>");
        
        echo "<div><p>Users:</p><ul><li>".$GLOBALS['db']->searchUser($keyword)."</li></ul></div>";
        
        echo "<div><p>Cars:</p><ul><li>".$GLOBALS['db']->searchCar($keyword)."</li></ul></div>";
    }
    
}
function showSubmit(){
    ?>

            <div data-role="main" class="ui-content">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                </form>
            </div>

            </div>
            <?php
}function showError($messsage){
    ?>

                <div data-role="main" class="ui-content">
                    <p>
                        <?php $message ?>
                    </p>
                </div>
                </div>
                <?php
                        }
function showLastImages(){
    $images = $GLOBALS['db']->getLastImages();
    
    for($i = 0; $i < sizeof($images); $i++){
        echo "<div class='ui-block'><img class='previewimg' src='". $images[$i]->path.$images[$i]->name."' /></div>";
        
    }
}
function showCars($user){
    $images = $GLOBALS['db']->getUsersImages($user);
    
    for($i = 0; $i < sizeof($images); $i++){
        echo "<div class='ui-block'><img class='previewimg' src='". $images[$i]->path.$images[$i]->name."' /></div>";
        
    }
}
