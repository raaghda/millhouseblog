<?php

require 'parts/database.php';
require 'parts/functions.php';

//GET post ID from the query string
$post_id = $_GET["id"];

//Calls notification function if message needs to be displayed.  
display_notification();

?>
   
    <div class="container-fluid viewpost">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1">
                   
                <!--INCLUDE PHP FOR DISPLAY POST HERE-->
                <?php require 'parts/viewpostdisplaypost.php';?>
                      
                <!--INCLUDE PHP FOR COMMENTS HERE--> 
                <?php require 'parts/viewpostcomments.php';?>      
             
                <!--INCLUDE PHP ADD COMMENTS HERE-->
                <?php require 'parts/viewpostaddcomment.php';?>       
            
            </div><!--col-lg-9--><!--CONTAINS ALL CONTENT PARTS-->

            <!--SIDEBAR-->
            <div class="col-lg-2 hidden-xs-down sidebar_container">
                <?php require 'components/sidebar.php';?>
            </div><!--/sidebar-->
                
        </div><!--/row-->
    </div><!--end of container viewpost-->