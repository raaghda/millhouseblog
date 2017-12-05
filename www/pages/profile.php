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
        <div class="col-10 offset-1">
            <img src="images/empty_avatar.png" id=profile_avatar 
            alt="Avatar för användare" class="rounded-circle" width="120px" height="120px">
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
        <div class="col-lg-10 offset-lg-1">
            <span class="uppercase">    
                <h1>Senaste inläggen:</h1>
            </span>
        </div>
    </div>
    
    <!-- Displays message if user has made 0 posts -->
    <?php
    if ($posts_by_user['total'] == 0)
    { ?>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <p>Du har inte gjort något inlägg ännu.</p>
            </div>
        </div>  
    <?php }

    //SQL-query fetching posts made by user, and details about that post
    //Saves everything into an array ($post) with the help of array using array_keys-function
    $statement = $pdo->prepare("SELECT * 
    FROM post 
    WHERE userid = $userid 
    ORDER by date DESC");
    $statement->execute();
    $post = $statement->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($post);

    //Loop displaying (max) five latest posts made by user
    for($i=0; $i<5; $i++):

        //Checks if the index $i is less than the total number of posts
        if ($i < count($post))
        {
            //Fetches information from array in "parts/fetchprofile.php" 
            //Puts this into new variables for each post in loop
            $post_id = $post[$keys[$i]]['postid'];
            $category_id = $post[$keys[$i]]['categoryid'];
            $post_date = $post[$keys[$i]]['date']; 
            $dt = new datetime($post_date); 
            
            //Fetches category name from a row in a table,
            // using an id to compare with the id's in the table
            $category_name = get_column_with_input('name', 'category', 'categoryid', $category_id);

            //Function for counting the total comments on each post displayed in the loop
            $number_of_comments = count_comments($post_id);

            //Puts post text into new variable, and uses a function for 
            //limiting the number of characters to be displayed to 300
            $post_text = make_string_shorter($post[$keys[$i]]['text'], 300);
            ?>
        
            <!-- Single post-content -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1"> 
                    <article class="posts_displayed_on_profile_page">
                        <span class="uppercase grey"> <?=$category_name?> </span>
                         <h2 class=”postheading”> <?=$post[$keys[$i]]['title'];?> </h2>
                        <span class=grey>
                            <time> Publicerat  
                                <?= $dt->format('Y-m-d'); ?>
                            </time>
                        </span>
                        <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments">
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
                        </a>
                        <p> <?=$post_text?> </p>
                        <div class="row post_actions">
                            <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
                            <span class="lightblue indent_left indent_right">|</span>
                            <form action="./?page=editpost" method="POST">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <input type="submit" ID="edit_post_via_profile" name="edit" value="Redigera inlägg">
                            <span class="lightblue indent_left indent_right">|</span>
                            </form>
                            <form action="../www/parts/deletepost.php" method="POST">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <input type="submit" ID="delete_post_via_profile" name="delete" 
                                value="Ta bort" onclick="return confirm('Är du säker att du vill ta bort inlägget?')">   
                            </form>
                        </div>
                    </article>
                </div> <!-- Closing row for each post-->
            </div> <!-- Closing col for each post -->
        <?php } endfor; ?>

    <!-- All posts by user - Obs! Currently empty!! -->
    <div class="col-lg-10 offset-lg-1"> 
        <div class="d-flex flex-row-reverse">
            <a href="#">Alla inlägg</a>
        </div>
    </div>
        
    <!-- Latest comments -->
    <div class="row">
        <div class="col-lg-10 offset-lg-1">   
            <span class="uppercase">    
                <h1>Dina senaste kommentarer:</h1>
            </span>
        </div>
    </div>
    
    <!-- Displays message if user has made 0 comments -->
    <?php
    if ($comments_by_user['total'] == 0)
    { ?>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <p>Du har inte skrivit några kommentarer ännu.</p>
            </div>
        </div>  
    <?php }

    //SQL-query fetching comments made by user, and details about that comment
    //Saves everything into an array ($comments) with the help of array using array_keys-function
    $statement = $pdo->prepare("SELECT * FROM comment WHERE userid = $userid ORDER by date DESC");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($comments);

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
            $dt = new datetime($date); 

            //Fetches post-title from a row in a table,
            // using an id to compare with the id's in the table
            $post_title = get_column_with_input("title", "post", "postid", $post_id);

            //Puts comment text into new variable, and uses a function for 
            //limiting the number of characters to be displayed to 200
            $comment_text = make_string_shorter($comments[$keys[$i]]['comment'], 200);
            ?>  

            <!-- Comment-content -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">    
                    <article class="comments_displayed_on_profile_page">
                        <span class="grey">
                            Du kommenterade på
                            <a href="/millhouseblog/www/?page=viewpost&id=
                            <?= $post_id ?>"><?= '"' . $post_title . '"' ?> </a>
                            <time class="grey"> den
                            <?= $dt->format('Y-m-d'); ?>
                            </time>
                            <p id="comment_text"> <?=$comment_text;?> </p>
                        </span>
                    </article>    
                </div> <!-- Closing row for each comment-->
            </div> <!-- Closing col for each post -->
    <?php } endfor; ?>
</div> <!-- Closing container profile content -->