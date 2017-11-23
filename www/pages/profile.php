<?php
require 'parts/database.php';
require 'parts/functions.php';
require 'parts/logincheck.php';

// 1. VI BEHÖVER HÄMTA USERID (KOPIERA SAMMA LOGIK SOM VI HAR GET PARAMETERN PAGE OCH ÄNDRA DEN TILL USERID)
$userid = $_SESSION["user"]["userid"];

// 2. HÄMTA EN ANVÄNDARE FRÅN DATABASEN SOM HAR DET USERID SOM VI FICK FRÅN GET-PARAMETERN (SE KODEN I LOGIN HUR VI HÄMTAR USERINFORMATION FRÅN DATABASEN)
$statement = $pdo->prepare(
    "SELECT username, userid, email, name, role, registertime 
    FROM user 
    WHERE userid = :userid");

$statement->execute(array(
":userid" => $userid
));

//We save the profile details in an array, called fetched user
$fetched_user = $statement->fetch(PDO::FETCH_ASSOC);

//Declares empty variables to avoid them being "undefined" before value is set
$posts_by_user = '';
$comments_on_users_posts = '';


//Variable for formating date and time correctly
$date = $fetched_user["registertime"];
$dt = new datetime($date);



//SQL-query fetching total number of POSTS made by user
$statement = $pdo->prepare(
    "SELECT COUNT(post.postid) 
    AS total 
    FROM post INNER JOIN user 
    ON post.userid = user.userid 
    WHERE user.userid = $userid");
$statement->execute(array(
    ":total" => $posts_by_user
    ));
$posts_by_user = $statement->fetch(PDO::FETCH_ASSOC);


//SQL-query fetching total number of COMMENTS on posts made by user
$statement = $pdo->prepare(
    "SELECT COUNT(comment.commentid)
    AS total
    FROM comment
    LEFT JOIN post
    ON comment.postid = post.postid
    WHERE post.userid = $userid");
$statement->execute(array(
":total" => $comments_on_users_posts
));
$comments_on_users_posts = $statement->fetch(PDO::FETCH_ASSOC);
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
            </br> Medlem sedan 
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

    //Fetches posts made by logged in user, using the same display posts-strucutre as in home
    $statement = $pdo->prepare("SELECT * FROM post WHERE userid = $userid ORDER by date DESC");
    $statement->execute();
    $post = $statement->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($post);


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
                <!-- Link to edit-post will be added -->
                <a href="#">Redigera inlägg</a>
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
    $statement = $pdo->prepare("SELECT * FROM comment WHERE userid = $userid ORDER by date DESC");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($comments);
    
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
        ?>  
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">    
                <article class="comment_box">
                    <span class="uppercase grey"><?=$category_name?></span>
                    <h3><?=$post_title?></h3>                
                    <p>Din kommentar: 
                    <?=$comments[$keys[$i]]['comment'];?></p>
                    <time class="grey">Kommenterades den: 
                    <?= $dt->format('Y-m-d'); ?>
                    </time>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
                    
                </article>
            </div> <!-- Closing row for each comment-->
        </div> <!-- Closing col for each post -->
        <?php } endfor; ?>
</div> <!-- Closing container profile content -->
    