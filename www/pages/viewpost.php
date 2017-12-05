<?php

require 'parts/database.php';
require 'parts/functions.php';

//GET post ID from the query string
$post_id = $_GET["id"];

//Calls notification function if message needs to be displayed.  
display_notification();

?>
   
<main class="main_viewpost">
    <div class="container viewpost">
        <div class="row">
            <div class="col-lg-9">
                   
                <!--INCLUDE PHP FOR DISPLAY POST HERE-->
                <?php require 'parts/viewpostdisplaypost.php';?>
                      
                <!--INCLUDE PHP FOR COMMENTS HERE--> 
                <?php require 'parts/viewpostcomments.php';?>      
                                    
                <!--INCLUDE PHP ADD COMMENTS HERE-->
                <?php require 'parts/viewpostaddcomment.php';?>       
        
            </div><!--col-lg-9--><!--CONTAINS ALL CONTENT PARTS-->

            <!--SIDEBAR-->
            <div class="col-lg-3 sidebar hidden-xs-down">
                <?php require 'components/sidebar.php';?>
            </div><!--/sidebar-->
                
        </div><!--/row-->
    </div><!--end of container viewpost-->
</main>