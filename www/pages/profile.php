<?php
require 'parts/database.php';
require 'parts/functions.php';
require 'parts/logincheck.php';
require 'parts/fetchprofile.php';
display_notification();
?>

<!-- Profile "header" with user stats etc -->
<div class="container-fluid profile_header">
     <?php require 'parts/userprofile.php' ?>
</div> <!-- Closing Profile header  -->


<!-- Container for five latest posts and comments by user -->
<div class="container profile_content">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <span class="uppercase">    
                <h1>Senaste inläggen</h1>
            </span>
        </div>
    </div>
    
    <!-- Displays message if user has made 0 posts -->
    <?php
    if ($posts_by_user['total'] == 0): ?>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <p>Du har inte gjort något inlägg ännu.</p>
            </div>
        </div>  
    <?php endif; ?>

    <!-- Latest posts made by user -->
    <div class="row">
        <div class="col-lg-10 offset-lg-1"> 
            <article class="posts_displayed_on_profile_page">
            <!-- We fetch the content of the post from parts/profilepost -->
            <?php require 'parts/profilepostcontent.php'; ?>
            </article>
        </div> 
    </div>

    <!-- Link to view all my posts-page -->
    <div class="col-lg-10 offset-lg-1"> 
        <div class="d-flex flex-row-reverse">
        <a href="/millhouseblog/www/?page=myposts">(Se alla inlägg)</a>
        </div>
    </div>
        
    <!-- Latest comments -made by user -->
    <div class="container_comments_displayed_on_profile_page">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">   
                <span class="uppercase">    
                    <h1>Dina senaste kommentarer</h1>
                </span>
            </div>
        </div>
        
        <!-- Displays message if user has made 0 comments -->
        <?php if ($comments_by_user['total'] == 0): ?>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <p>Du har inte skrivit några kommentarer ännu.</p>
                </div>
            </div>  
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">    
                <!-- We fetch the content of the comments from parts/profilecomments -->
                <?php require 'parts/profilecommentcontent.php'; ?>
            </div> 
        </div> 
    </div> <!-- Closing container for comments_displayed_on_profile_page -->
</div> <!-- Closing container profile content -->