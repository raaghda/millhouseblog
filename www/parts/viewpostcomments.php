
                <!--DISPLAYS COMMENTS-->   
                <div class="row">
                    <div class="col-lg-12">
                        <span class="uppercase">
                            <h1 class="light_spacious" id="comments_h1">Kommentarer</h1>
                            <a name="comments"></a><!--anchor to comments section.#comments will bring user to this line-->
                        </span>
                                    
                                <?php
                                    //if statement when there are no comments
                                    if ($number_of_comments == 0){?>
                                       
                                <div class="row">
                                    <div class="col-lg-12 "> 
                                        <div class="comments_displayed_on_viewpost_page">
                                            <p>Det finns inga kommentarer här än.</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <?php   
                                    }else
                                
                                        foreach($comments as $comment_info){
                                            $date = $comment_info["date"]; 
                                            $dt = new datetime($date);
                                            $role = '';
                                            $post_id = get_column_with_input('postid', 'comment', 'postid', $comment_info["postid"]);
                                            
                                            
                                            
                                            //if a person that made a comment isnt a user, and therefore has no userid..
                                            //..get email from comment table.
                                            //else store user id and get username from user table
                                            
                                            if($comment_info['userid'] == NULL){
                                                $comment_name = $comment_info['email'];
                                            } else {
                                                $user_id = $comment_info['userid'];
                                                $comment_name = get_column_with_input('username', 'user', 'userid', $user_id);
                                            }
                                    //LOOPING OUT COMMENTS
                                ?>
                        <div class="row">
                            <div class="col-lg-12 ">    
                                <article class="comments_displayed_on_viewpost_page">
                                    <span class="grey">Kommentar lämnade av 
                                        <span id="commentbox" class="uppercase lightblue"><?=$comment_name?></span>
                                        den  
                                        <time id="commentbox">
                                              <?=$dt->format('Y-m-d, G:i');?>
                                        </time>
                                        <p id="comment_text"><?=$comment_info["comment"] ?></p>
                                    </span>
                                    
                                    <?php
                                        if(isset($_SESSION['loggedIn'])){
                                            $role = $_SESSION['user']['role'];
                                        }
                    
                                        if ($role == 'admin'){?>

                                    <form action="../www/parts/deletecomment.php" method="GET">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        <input type="hidden" name="post_id" value="<?= $post_id;?>">
                                        <input type="hidden" name="comment_id" value="<?= $comment_info['commentid'];?>">
                                        <input type="submit" id="delete_post_via_profile" name="delete" value="Ta bort">
                                    </form>

                                    <?php
                                        }//END OF IF STATEMENT CHECKING ADMIN LOGIN
                                    ?>  
                                                    
                                </article>  
                            </div> <!-- Closing col for each comment -->                
                        </div>  <!-- Closing row for each comment--> 
                            
                        <?php
                            }//END OF COMMENTS FOREACH LOOP
                        ?>
                              
                    </div><!--end of col-lg-12-->
                </div><!--END OF DISPLAY COMMENTS -- end of row-->