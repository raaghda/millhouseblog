<!--checks user is logged in-->


<?php


if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] == true) 

    {
        //Calling function to notify with danger and message
        //Calling funtion to display notification
        notify('danger', 'Du måste vara inloggad för att kunna se den här sidan. <a href="/millhouseblog/www/?page=home">');
        display_notification();
        exit();
    
        //'exit()' stops the page from rendering, so the user does not have access to the page if not logged in.
        //http://php.net/manual/en/function.exit.php
    }
