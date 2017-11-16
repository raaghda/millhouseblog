<?php

//Just testing to make sure i can access the database and pull back an individual post.
//http://localhost:8888/millhouseblog/www/components/viewpost.php?postid=2

require 'parts/database.php';
require 'parts/functions.php';

$post_id = $_GET["id"];

$statement = $pdo->prepare("SELECT * FROM post WHERE postid = $post_id");
$statement->execute();
$post = $statement->fetchAll(PDO::FETCH_ASSOC);


    foreach ($post as $post_info){ 
        $user_id = $post_info['userid'];
        $post_id = $post_info['postid'];
        $category_id = $post_info['categoryid'];
              
        $username = get_row_with_input('username', 'user', 'userid', $user_id);
        $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);

        //FETCH COMMENTS
        $statement = $pdo->prepare("SELECT * FROM comment INNER JOIN post ON comment.postid = post.postid WHERE comment.postid = $post_id");
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        $number_of_comments = count($comments);
        
        //LOOPING OUT POST
        ?>
        <article class="post">
            <header>
                <!--<meta>kategorierna som meta???-->
                <h2><?=$post_info['title']?></h2>
                <span>Publicerat av <?= $username ?> den <time><?=$post_info['date']?></time></span>

                <a href="/millhouseblog/www/?page=category&categoryid=<?=$category_id?>"><?=$category_name?></a>
            
                
                <a href=""><?= $number_of_comments?> Kommentarer</a> 
            </header>
            
            <p><?=$post_info['text'];?></p>
        
              <?php
                foreach($comments as $comment_info){
                    $user_id = $comment_info['userid'];
                    $username = get_row_with_input('username', 'user', 'userid', $user_id);
                    
                //LOOPING OUT COMMENTS
                ?>
                <article class=”comment”> 
                    <header>
                        <time><?=$comment_info['date']?></time> 
                        <span> av <?=$username?></span>
                    </header>
                    
                    <p><?=$comment_info["comment"]?></p>    
                    
                    <?php
                    }
                    ?>
                </article><!--/comment article-->    
        </article><!--/post article-->
    <?php
    }


if(isset($_GET['nocomment'])){
    echo $_GET['nocomment'];
            }

?>

<form action="parts/addcomment.php" method="post">
    
    <? if(!isset($_SESSION['loggedIn'])){ ?>
       
       <input type="text" name="name" placeholder="Namn">
       <input type="text" name="email" placeholder="Email">
        
    <?  } else {} ?>
    
    <input type="hidden" name="id" value="<?= $postid ?>">
    <input type="text" name="comment" placeholder="Kommentar">
    <input type="submit" name="addcomment" value="Skicka">
    
</form>

