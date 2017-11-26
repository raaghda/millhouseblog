<?php
require 'parts/database.php';
require 'parts/functions.php';
require 'parts/logincheck.php';
require 'parts/fetchprofile.php';

?>


<div class="container-fluid profile_header">
     <div class="row">
        <div class="col-6 offset-3">
            <img src="images/empty_avatar.png" id=profile_avatar alt="Avatar för användare" 
            class="rounded-circle" width="150px" height="150px">
            <h1 id=user_name> <?php echo $fetched_user["name"]; ?> </h1>
        </div>
    </div>
              
    <div class="row">
        <div class="col-6 offset-3 d-none d-md-block"> 
            <p id=user_stats> <?= $posts_by_user['total'] ?> inlägg på bloggen </br>
            <?php if($comments_on_users_posts['total'] == 1)
                        {
                        echo $comments_on_users_posts['total'] . ' mottagen kommentar'; 
                        } 
                        else
                        {
                            echo $comments_on_users_posts['total'] . ' mottagna kommentarer';
                        } ?>
            </br>Medlem sedan 
            <time> <?= $dt->format('Y-m-d'); ?> </time></p>
        </div>
    </div>
    
    <div class="row">
        <div class="mx-auto">
            <a class="btn" href="/millhouseblog/www/?page=createpost">Skriv nytt inlägg
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        </div>
    </div>
</div> <!-- Closing profile_header container -->


<div class="container profile_content">
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">    
            <h1>Senaste inläggen:</h1>
        </div>
    </div>
    
    <?php
    if ($posts_by_user['total'] == 0)
    { ?>
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <p>Du har inte gjort något inlägg ännu.</p>
            </div>
        </div>  
    <?php }

    

  



     //Loop through and display latest post (max 5)     
    for($i=0; $i<5; $i++):

   

        //if the index $i is less than the total number of posts
        if ($i < count($post))
        {

        $post_id = $post[$keys[$i]]['postid'];
        $category_id = $post[$keys[$i]]['categoryid'];
        $date = $post[$keys[$i]]['date'];
        $dt = new datetime($date);

        $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);
        $number_of_comments = count_comments($post_id);

        //Puts post text into new variable, and uses a function for 
        //limiting the number of characters to be displayed to 300
        $post_text = make_string_shorter($post[$keys[$i]]['text'], 300);

        ?>
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">    
                <article class="post">
                    <header>  
                    <span class="uppercase grey"><?=$category_name?></span>
                    <h2 class=”postheading”><?=$post[$keys[$i]]['title'];?></h2>
                    <time class="grey">Publicerat den:  
                        <?= $dt->format('Y-m-d'); ?>
                    </time>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments">
                    <?= 
                    '(' . $number_of_comments . ')'; 
                    if($number_of_comments == 1)
                    {
                        echo ' kommentar'; 
                    } 
                    else
                    {
                        echo ' kommentarer';
                    } 
                    ?>
                    </a>
                    </header>
                    <p><?=$post_text?></p>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
                    <form action="./?page=editpost" method="POST">
                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <input id="edit_button" type="submit" name="edit" value="Edit">
                    </form>
                    
                    <form action="../www/parts/deletepost.php" method="POST">
                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <input type="submit" name="delete" value="Delete">   
                    </form>
                
                </article>
            </div> <!-- Closing row for each post-->
        </div> <!-- Closing col for each post -->
    <?php } endfor; ?>

        

    <div class="row">
        <div class="user_comments_wrapper col-12 col-lg-8 offset-lg-2">   
            <!-- Put this in if-statement? Showing something different when comments == 0-->
            <h1>Dina senaste kommentarer:</h1>
        </div>
    </div>

    <?php
    if ($comments_by_user['total'] == 0)
    { ?>
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <p>Du har inte skrivit några kommentarer ännu.</p>
            </div>
        </div>  
    <?php }

   
    
    //Loop through and display latest comments by user (max 5)     
    for ($i = 0; $i < 5; $i++):
        //if the index $i is less than the total number of posts
        if ($i < count($comments))
        {
        $post_id = $comments[$keys[$i]]['postid'];
        $comment_date = $comments[$keys[$i]]['date'];
        $comment_id = $comments[$keys[$i]]['commentid'];
        $comment = $comments[$keys[$i]]['comment'];
        $date = $comments[$keys[$i]]['date'];
        $dt = new datetime($date);

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
                        <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
                        
                    </article>
                </div> <!-- Closing row for each comment-->
            </div> <!-- Closing col for each post -->
        <?php } endfor; ?>
</div> <!-- Closing container profile content -->
    