<?php
require 'parts/database.php';
require 'parts/functions.php';

// 1. VI BEHÖVER HÄMTA USERID (KOPIERA SAMMA LOGIK SOM VI HAR GET PARAMETERN PAGE OCH ÄNDRA DEN TILL USERID)

$userid = $_SESSION["user"]["userid"];

// 2. HÄMTA EN ANVÄNDARE FRÅN DATABASEN SOM HAR DET USERID SOM VI FICK FRÅN GET-PARAMETERN (SE KODEN I LOGIN HUR VI HÄMTAR USERINFORMATION FRÅN DATABASEN)

$statement = $pdo->prepare("SELECT username, userid, email, name, role, registertime FROM user WHERE userid = :userid");

$statement->execute(array(
":userid" => $userid
));

$fetched_user = $statement->fetch(PDO::FETCH_ASSOC);

?>

<div class="container-fluid profile_header">
     <div class="row">
        <div class="col-6 offset-3">
            <img src="images/empty_avatar.png" id=profile_avatar alt="Avatar för användare" class="rounded-circle" width="150px" height="150px">
            <h1 id=user_name> <?php echo $fetched_user["name"]; ?> </h1>
        </div>
    </div>
              
    <div class="row">
        <div class="col-6 offset-3 d-none d-md-block"> 
            <p id=user_stats>XX inlägg med XX kommentarer </br>
            Medlem sedan <?php echo $fetched_user["registertime"];?> </p>
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
    $statement = $pdo->prepare("SELECT * FROM post WHERE userid = {$userid} ORDER by date DESC");
    $statement->execute();
    $post = $statement->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($post);

    for($i=0; $i<5; $i++):
    $user_id = $post[$keys[$i]]['userid'];
    $post_id = $post[$keys[$i]]['postid'];
    $category_id = $post[$keys[$i]]['categoryid'];

    $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);
    $username = get_row_with_input('username', 'user', 'userid', $user_id);

    $number_of_comments = count_comments($post_id);
    
    if($post_id == NULL)
    {
        //Fixes problem with "empty posts" showing if there are less than five posts
        break; 
    }
    else
    { 
        //Loop through and display latest post (max 5)
    ?>  
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">    
            <article class="post">
                <header>  
                <span class="uppercase grey"><?=$category_name?></span>
                <h2 class=”postheading”><?=$post[$keys[$i]]['title'];?></h2>
                <time class="grey">Publicerat den: <?=$post[$keys[$i]]['date'];?></time>
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
                <p><?=$post[$keys[$i]]['text'];?></p>
                <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
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
            <h1>Dina senaste kommentarer:</h1>
        </div>
    </div>

    <?php
    $statement = $pdo->prepare("SELECT * FROM comment WHERE userid = {$userid} ORDER by date DESC");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($comments);

    for ($i = 0; $i < 5; $i++):
        $post_id = $comments[$keys[$i]]['postid'];
        $user_id = $comments[$keys[$i]]['userid'];
        $comment_date = $comments[$keys[$i]]['date'];
        $comment_id = $comments[$keys[$i]]['commentid'];
        $comment = $comments[$keys][$i]['comment'];

        $post_title = get_row_with_input("title", "post", "postid", $post_id);

        if($comment_id == NULL)
        {
            //Same fix as posts - fixes problem with "empty comments" showing if there are less than five
            break; 
        }
        else
        {
        ?>  
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">    
                <article class="comment_box">
                    
                    <span class="uppercase grey"><?=$category_name?></span>
                    <h3><?=$post_title?></h3>                    
                    <p>Din kommentar: 
                    <?=$comments[$keys[$i]]['comment'];?></p>
                    <time class="grey">Kommenterades den: <?=$comments[$keys[$i]]['date']?></time>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
                    
                </article>
            </div> <!-- Closing row for each comment-->
        </div> <!-- Closing col for each post -->
        <?php } endfor; ?>
</div> <!-- Closing container profile content -->
    