<!--checks user is logged in-->

<?php

if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] == true) 

    {
        //Calling function to notify with danger and message
        //Calling funtion to display notification
        notify('danger', 'Du måste vara inloggad för att kunna se den här sidan.');
        display_notification();
        require 'pages/loginform.php';
        require 'components/footer.php';

        //'exit()' stops the unauthorized page from rendering, 
        //so the user does not have access to the page if not logged in.
        exit();
    }
