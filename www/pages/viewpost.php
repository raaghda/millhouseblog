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
        
        display_notification();
        ?>
        
        

    <div class="container viewpost">
        <h1></h1>
            <div class="row">
               <div class="col-lg-9">
               <article class="post">
               
                    <header>

                        <!--<meta>kategorierna som meta???-->
                        <h2>
                            <?=$post_info['title']?>
                        </h2>


                        <span id="viewpost_span">Publicerat av <?= $username.' '. '('.$user_email.')'; ?> den 
                           <time>
                            <?= $dt->format('Y-m-d'); ?>
                            </time>
                       </span>
                       
                        <h6 #id="category">
                            <a href="/millhouseblog/www/?page=category&categoryid=<?=$category_id?>">
                                <?=$category_name?>
                            </a>
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

                        <!--display image, and display title as alt tag-->
                        <div class="blogpost_image">
                            <img src="/millhouseblog/www/postimages/<?=$image?>" class="img-fluid" alt="<?=$title;?>">
                        </div>
                        <?php
            }
            ?>

                            <div class="text_container">
                                <p>
                                    <?=$post_info['text'];?>
                                </p>
                            </div>
                            
                            
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
                   
                         <div class="row justify-content-end">
                           <div class="col-6"></div>
                            <div class="col-3" >
                                <form action="../www/parts/deletepost.php" method="POST">
                                    <input type="hidden" name="post_id" value="<?= $post_info['postid'];?>">
                                    <input id = "delete_button" type="submit" name="delete" value="Ta bort" onclick="return confirm('Är du säker att du vill ta bort inlägget?')">
                                </form>
                             </div>
                             
                           <div class="col-3">
                                <form action="./?page=editpost" method="POST">
                                    <input type="hidden" name="post_id" value="<?= $post_info['postid'];?>">
                                    <input id="edit_button" type="submit" name="edit" value="Redigera">
                                </form>
                            </div>  
                        </div>
                       
                                            

                    <? } else if ($role == 'admin'){  ?>

                        <form action="../www/parts/deletepost.php" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post_info['postid'];?>">
                            <input type="submit" name="delete" value="Delete">
                        </form>



                        <?php
    }
            
//var_dump((int)$_SESSION['user']['userid']);            
?>
                            
                
                 </article><!--/post article-->
                 
            
         
       


        <div class="row">
            <div class="user_comments_wrapper col-12 col-lg-8 ">
                <!-- Put this in if-statement? Showing something different when comments == 0-->
                <h2>Kommentarer</h2>
            </div>
        </div>
        
       
        <a name="comments"></a>
        <!--anchor to comments section.#comments will bring use to this line-->

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
            <article class="comment_box">
                <header>
                    <time id="commentbox"><?=$dt->format('Y-m-d'); ?></time>
                    <p id="commentbox">av</p>
                    <span id="commentbox" class="uppercase grey"><?=$comment_name?></span>
                </header>

                <p>
                    <?=$comment_info["comment"] ?>
                </p>


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
            </article>
            <!--/comment article-->

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


     </div><!--col-lg-9-->
       
        <!--SIDEBAR-->
                <div class="col-lg-3 sidebar hidden-xs-down">
                    <?php
        require 'components/sidebar.php';
        ?>
                </div><!--/sidebar-->
        </div><!--/row-->   
    </div>
    <!--end of container viewpost-->