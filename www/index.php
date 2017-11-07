<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <title>Document</title>

</head>
<body>
   
    <?php
    
        /*------     IF ISSET = IF USER IS LOGGED IN     ------*/

        if(isset($_SESSION["user"])){

            echo '<h1>' . "Welcome " . $_SESSION["user"]["username"] . '!' . '</h1>';

    ?>
            
            <form action="parts/logout.php">
                <input type="submit" name="logout" value="Logga ut">
            </form>
       
    <?php
        
    /*------     EVERYTHING THAT HAPPENS BEFORE ELSE, IS IF USER LOGGED IN    ------*/
    
        } else {
        
            /*------     LOG OUT MESSAGE BELOW, AND LOGIN-FORM IF NOT LOGGED IN     ------*/

            if(isset($_GET['logout'])){
                echo $_GET['logout'];
            }
       
        require 'parts/loginform.php';
        
        }
    
    ?>
    
</body>
</html>