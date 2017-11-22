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
        $image = $post_info['image'];
        $title = $post_info['title'];
        $date_of_post = $post_info['date'];
        $dt = new datetime($date_of_post);
        
        $username = get_row_with_input('username', 'user', 'userid', $user_id);
        $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);
        $user_email = get_row_with_input('email', 'user', 'userid', $user_id);

        //FETCH COMMENTS
        //Select all from comments table where postid = $post_id from query above
        $statement = $pdo->prepare("SELECT * FROM comment WHERE postid = $post_id");
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        $number_of_comments = count($comments);
        
        //LOOPING OUT POST
        ?>
        <div class="container viewpost">
        <article class="post">
            <header>
               
                <!--<meta>kategorierna som meta???-->
                <h2><?=$post_info['title']?></h2>
                
                
                <span>Publicerat av <?= $username.' '. '('.$user_email.')'; ?> den <time>
            <?= $dt->format('Y-m-d'); ?>
        </time></span>
                <h6 #id="category">
                <a href="/millhouseblog/www/?page=category&categoryid=<?=$category_id?>"><?=$category_name?></a>
                </h6>
                
                <h6 id="comments">
                <a href="#comments">
                    <?= '(' . $number_of_comments . ')'; 
        
                    if($number_of_comments == 1){
                        echo ' kommentar'; } else{
                        echo ' kommentarer';
                    } 
                    
                    ?> 
               
                </a> 
                </h6>
            </header>
             
            <?php
            //if NOT no image (i.e. if there is an image)
            if (!is_null($image)){?>
            
            <!--display image and title as alt tag-->
            <img src="/millhouseblog/www/postimages/<?=$image?>" class="img-fluid" alt="<?=$title;?>">
            <?php
            }
            ?>
            
            <div class="text_container">
                <p><?=$post_info['text'];?></p>
            </div>
            
            
            <a name="comments"></a><!--anchor to comments section.#comments will bring use to this line-->
              <?php
                foreach($comments as $comment_info){
                    $date = $comment_info["date"]; 
                    $dt = new datetime($date);
                    $role = '';
                    $post_id = get_row_with_input('postid', 'comment', 'postid', $comment_info["postid"]);
                    //if a person that made a comment isnt a user, and therefore has no userid..
                    //..get email from comment table.
                    //else store user id and get username from user table
                    if($comment_info['userid'] == NULL){
                        $comment_name = $comment_info['email'];
                    } else {
                        $user_id = $comment_info['userid'];
                        $comment_name = get_row_with_input('username', 'user', 'userid', $user_id);
                        }
                //LOOPING OUT COMMENTS
                ?>
                <article class=”comment”> 
                    <header>
                        <time>
            <?= $dt->format('Y-m-d'); ?>
        </time>
                        <span> av <?=$comment_name?></span>
                    </header>
                    
                    <p><?=$comment_info["comment"] ?></p>
                        
                    
                    <?php
                    
                    if(isset($_SESSION['loggedIn'])){
 $role = $_SESSION['user']['role'];
}
                    
                    if ($role == 'admin'){?>
                    
<form action="../www/parts/deletecomment.php" method="GET">
<input type="hidden" name="post_id" value="<?= $post_id;?>">
<input type="hidden" name="comment_id" value="<?= $comment_info['commentid'];?>">
<input type="submit" name="delete" value="Delete">   
</form> 
                        
                   <? }
                    
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
    
    <input type="hidden" name="id" value="<?= $post_id ?>">
    <input type="text" name="comment" placeholder="Kommentar">
    <input type="submit" name="addcomment" value="Skicka">
    
</form>


<?php

    $role = '';
    
if(isset($_SESSION['loggedIn'])){
 $role = $_SESSION['user']['role'];
}

//           
//    if($role = 'admin'){
//        echo 'YAY';
//    }

    //If-statement to check if a user is logged in and if that user is the author.
    //If both conditions are true, the user can delete and edit posts.
           
    if(isset($_SESSION['loggedIn']) && (int)$_SESSION['user']['userid'] == $user_id ){ ?>


<form action="../www/parts/deletepost.php" method="POST">
    <input type="hidden" name="post_id" value="<?= $post_info['postid'];?>">
    <input type="submit" name="delete" value="Delete">   
</form> 
                      
<form action="./?page=editpost" method="POST">
<input type="hidden" name="post_id" value="<?= $post_info['postid'];?>">
<input type="submit" name="edit" value="Edit">  
</form> 
                       
<? } else if ($role == 'admin'){  ?>
                      
<form action="../www/parts/deletepost.php" method="POST">
    <input type="hidden" name="post_id" value="<?= $post_info['postid'];?>">
    <input type="submit" name="delete" value="Delete">   
</form>
                       
                        
<!--action sends to editpost via MVC(?) in order to pick up the css sheet. -->

<?php
    }
            
//var_dump((int)$_SESSION['user']['userid']);            
?>                          
                            
</div>