<?php
require 'parts/database.php';
require 'parts/functions.php';
require 'parts/logincheck.php';
require 'parts/fetchprofile.php';

display_notification();
?>

<!-- CONTENT FOR PROFILE "HEADER" -->

<div class="container-fluid profile_header">
     <div class="row">
        <div class="col-6 offset-3">
            <img src="images/empty_avatar.png" id=profile_avatar 
            alt="Avatar för användare" class="rounded-circle" width="150px" height="150px">
            <h1 id=user_name> <?php echo $fetched_user['name']; ?> </h1>
        </div>
    </div>
          
    <!-- User stats -->
    <div class="row">
        <div class="col-10 offset-1 d-none d-md-block"> 
            <p id=user_stats> <?= $posts_by_user['total'] ?> inlägg på bloggen | 
            <?php if($comments_on_users_posts['total'] == 1)
                    {
                    //Fixes grammar for singular/plural posts
                    echo $comments_on_users_posts['total'] . ' mottagen kommentar'; 
                    } 
                    else
                    {
                        echo $comments_on_users_posts['total'] . ' mottagna kommentarer';
                    } ?>
            | Medlem sedan <time> <?= $dt->format('Y-m-d'); ?> </time></p>
        </div>
    </div>
    
    <!-- Create post-button -->
    <div class="row">
        <div class="mx-auto">
            <a class="btn" href="/millhouseblog/www/?page=createpost">Skriv nytt inlägg
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        </div>
    </div>
</div> <!-- CLOSING PROFILE "HEADER" -->


<!-- CONTENT FOR THE REST OF PROFILE STARTS HERE-->

<!-- Latest posts -->
<div class="container profile_content">
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">    
            <h1>Senaste inläggen:</h1>
        </div>
    </div>
    
    <!-- Displays message if user has made 0 posts -->
    <?php
    if ($posts_by_user['total'] == 0)
    { ?>
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <p>Du har inte gjort något inlägg ännu.</p>
            </div>
        </div>  
    <?php }

    //Loop displaying (max) five latest posts made by user
    for($i=0; $i<5; $i++):
        
        //Checks if the index $i is less than the total number of posts
        if ($i < count($post))
        {
            //Fetches information from array in "parts/fetchprofile.php" 
            //Puts this into new variables for each post in loop
            $post_id = $post[$keys[$i]]['postid'];
            $category_id = $post[$keys[$i]]['categoryid'];
            $date = $post[$keys[$i]]['date'];
            
            //Fetches category name from a row in a table,
            // using an id to compare with the id's in the table
            $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);

            //Function for counting the total comments on each post displayed in the loop
            $number_of_comments = count_comments($post_id);

            //Puts post text into new variable, and uses a function for 
            //limiting the number of characters to be displayed to 300
            $post_text = make_string_shorter($post[$keys[$i]]['text'], 300);
            ?>
        
            <!-- Single post-content -->
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">    
                    <article class="post">
                        <span class="uppercase grey"> <?=$category_name?> </span>
                        <h2 class=”postheading” ><?=$post[$keys[$i]]['title'];?> </h2>
                        <time class="grey"> Publicerat den:  
                            <?= $dt->format('Y-m-d'); ?>
                        </time>
                        <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments"></a>
                        <?= '(' . $number_of_comments . ')'; 
                        if ($number_of_comments == 1)
                        {
                            //Fixes grammar for singular comment/plural comments
                            echo ' kommentar'; 
                        } 
                        else
                        {
                            echo ' kommentarer';
                        } 
                        ?>
                        <p> <?=$post_text?> </p>
                        <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
                        <form action="./?page=editpost" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post_id ?>">
                            <input type="submit" name="edit" value="Edit">
                        </form>
                        <form action="../www/parts/deletepost.php" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post_id ?>">
                            <input type="submit" name="delete" value="Delete">   
                        </form>
                    </article>
                </div> <!-- Closing row for each post-->
            </div> <!-- Closing col for each post -->
        <?php } endfor; ?>

        
    <!-- Latest comments -->
    <div class="row">
        <div class="user_comments_wrapper col-12 col-lg-8 offset-lg-2">   
            <h1>Dina senaste kommentarer:</h1>
        </div>
    </div>
    
    <!-- Displays message if user has made 0 comments -->
    <?php
    if ($comments_by_user['total'] == 0)
    { ?>
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <p>Du har inte skrivit några kommentarer ännu.</p>
            </div>
        </div>  
    <?php }

   
    //LOOP DISPLAYING (MAX) FIVE LATEST COMMENTS MADE BY USER
    for ($i = 0; $i < 5; $i++):
        
        //Checks if the index $i is less than the total number of posts
        if ($i < count($comments))
        {
            //Fetches information from array in "parts/fetchprofile.php" 
            //Puts this into new variables for each comment in loop
            $post_id = $comments[$keys[$i]]['postid'];
            $comment_date = $comments[$keys[$i]]['date'];
            $comment_id = $comments[$keys[$i]]['commentid'];
            $comment = $comments[$keys[$i]]['comment'];
            $date = $comments[$keys[$i]]['date'];

            //Fetches post-title from a row in a table,
            // using an id to compare with the id's in the table
            $post_title = get_row_with_input("title", "post", "postid", $post_id);

            //Puts comment text into new variable, and uses a function for 
            //limiting the number of characters to be displayed to 200
            $comment_text = make_string_shorter($comments[$keys[$i]]['comment'], 200);
            ?>  
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">    
                    <article class="comment_box">
                        <h3><?=$post_title?></h3>     
                            <p>Din kommentar: 
                            <?=$comment_text;?></p>
                            <time class="grey">Kommenterades den: 
                            <?= $dt->format('Y-m-d'); ?>
                            </time>
                            <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>
                            ">Läs hela inlägget</a>
                        </article>
                    </div> <!-- Closing row for each comment-->
                </div> <!-- Closing col for each post -->
            <?php } endfor; ?>
</div> <!-- Closing container profile content -->