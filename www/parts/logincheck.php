<!--checks user is logged in-->


<?php


if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] == true) 
            {
            exit('You must be logged in to view this page');
            //'exit()' stops the page from rendering, so the user does not have access to the page if not logged in.
            //http://php.net/manual/en/function.exit.php
            }
