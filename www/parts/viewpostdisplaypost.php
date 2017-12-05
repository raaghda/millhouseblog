                   <!--DISPLAYS POST-->
                    <article class="post" id="postsection_viewpost">
                        <header>
                            <!--<meta>kategorierna som meta???-->
                            <span class="uppercase"> 
                                <h1 class="light_spacious"><?=$post_info['title']?></h1>
                            </span>
                            <span id="viewpost_span">Publicerat av <?= $username.' '. '('.$user_email.')'; ?> den 
                               <time>
                                <?= $dt->format('Y-m-d'); ?>
                                </time>
                            </span>
                            <h6 #id="category">
                                <a href="/millhouseblog/www/?page=category&categoryid=<?=$category_id?>"><?=$category_name?>
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


    //If-statement to check if a user is logged in and if that user is the author.
    //If both conditions are true, the user can delete and edit posts.
           
    if(isset($_SESSION['loggedIn']) && (int)$_SESSION['user']['userid'] == $user_id ){ ?>

                <div class="row justify-content-end">
                    <div class="col-6"></div>
                        <div class="col-3">
                            <form action="../www/parts/deletepost.php" method="POST">
                                <input type="hidden" name="post_id" value="<?= $post_info['postid'];?>">
                                <input id="delete_button" type="submit" name="delete" value="Ta bort" onclick="return confirm('Är du säker att du vill ta bort inlägget?')">
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
                ?>
                    </article><!--END OF post article-->