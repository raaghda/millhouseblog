<?php

require 'parts/database.php';
require 'parts/functions.php';

//GET post ID from the query string
$post_id = $_GET["id"];

//Prepare and execute a statement which pulls back all information relating to postid
$statement = $pdo->prepare("SELECT * FROM post WHERE postid = $post_id");
$statement->execute();
$post = $statement->fetchAll(PDO::FETCH_ASSOC);


    foreach ($post as $post_info){ 
        $user_id = $post_info['userid'];
        $post_id = $post_info['postid'];
        $category_id = $post_info['categoryid'];
        $image = $post_info['image'];
        $title = $post_info['title'];
        $date_of_post = $post_info['date'];
        $dt = new datetime($date_of_post);
        
        $username = get_column_with_input('username', 'user', 'userid', $user_id);
        $category_name = get_column_with_input('name', 'category', 'categoryid', $category_id);
        $user_email = get_column_with_input('email', 'user', 'userid', $user_id);
        
       
    }//END OF FOREACH LOOP
            

        //FETCH COMMENTS
        //Select all from comments table where postid = $post_id from query above
        $statement = $pdo->prepare("SELECT * FROM comment WHERE postid = $post_id");
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        $number_of_comments = count($comments);
        
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