<?php
    require 'parts/database.php';
    require 'parts/functions.php';
    require 'parts/paginationstart.php';
 
    //if statement checking if there is a session message (parts/deletepost.php)
    //if true, display message
    display_notification();    

    //search function
    $query = "";    
    if(isset($_GET['query'])) {
        $q=$_GET['query'];
        $query = "WHERE title like '%$q%'";
    }    
?>

<!-- FEED CONTAINER - WRAPS ENTIRE HOME, POSTS AND SIDEBAR -->
<div class="container-fluid feed_container"> 
    <span class="uppercase">   
        <h1 class="light_spacious">Senaste inläggen</h1>
    </span>

    <div class="row">
        <div class="five_latest_posts_container col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1">

            <!-- Post content -->
            <?php require 'parts/homepostcontent.php';?>
            
            <!-- Pagination links below posts -->
            <nav>
                <ul class="pagination">
                    <?php require 'parts/paginationlinks.php';?>
                </ul>
            </nav> 
            
        </div> <!-- Closing five latests posts container -->
    
        <!-- Sidebar -->
        <div class="col-lg-2 d-none d-md-block sidebar_container">
            <?php require 'components/sidebar.php'; ?>
        </div> 

</div><!-- Closing entire feed container-->