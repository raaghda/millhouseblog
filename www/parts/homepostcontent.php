<?php

    $posts = fetch_all_posts_from_start_to_limit($start_limit, $limit);

    //unlock the ass array??:) and ready to loop
    $keys = array_keys($posts); 

    //Looping out 5 posts, starting from the latest posts.
    //Information about the author of the post=user.
    //How many comments there is on each post. 
    //Link to each specific post
    for($i=0; $i<count($posts); $i++):

        //check if the index $i is less than the total number of posts
        if ($i < count($posts)):

            //storing user_id to get to get user_name from user-table
            $user_id = $posts[$keys[$i]]['userid'];
            //storing post_id for the link to view the specific post
            //storing post_id to count how many comments it has, stored in number_of_comments
            $post_id = $posts[$keys[$i]]['postid'];
            //storing category_id to get the category_name from category table
            $category_id = $posts[$keys[$i]]['categoryid'];


            //FUNCTIONS is in functions.php
            $category_name = get_column_with_input('name', 'category', 'categoryid', $category_id);
            $username = get_column_with_input('username', 'user', 'userid', $user_id);
            $user_email = get_column_with_input('email', 'user', 'userid', $user_id);
            $date = $posts[$keys[$i]]['date'];
            $dt = new datetime($date); 
            $image = $posts[$keys[$i]]['image'];
            $title = $posts[$keys[$i]]['title'];

            //if post-text is longer than 120ch, shorten it
            $post_text = make_string_shorter($posts[$keys[$i]]['text'], 150);

            //if title-text is longer than 30ch, shorten it
            $post_title = make_string_shorter($posts[$keys[$i]]['title'], 30);

            //count comments of this post
            $number_of_comments = count_comments($post_id);

            //LOOPING OUT THE CONTENT OF THE POSTS:
            ?>  
            <article class="single_post_in_feed">
                <div class="row">
                    <div class="thumbnail_wrapper col-md-4">
                        <div class="thumbnail">
                            <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">
                                <img src="/millhouseblog/www/postimages/<?=$image?>" class="post_image" alt="<?=$title;?>">
                            </a>
                        </div>
                    </div>

                    <div class="post_content col-md-8">
                        <header>  
                            <span class="uppercase grey"><?=$category_name?></span>
                            <h2 class=”postheading”>
                                <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>"><?=$post_title;?></a>
                            </h2>
                            <span class="grey">
                                Publicerat 
                                <time>
                                    <?= $dt->format('Y-m-d'); ?>
                                </time>
                                av
                            </span>
                            <span class="uppercase grey"><?= $username?></span>
                        </header>

                        <p id="post_paragraph"><?=$post_text?></p>

                        <nav>
                            <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">
                                Läs hela inlägget
                            </a>

                            <span class=lightblue>|</span> 

                            <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments">
                                <?= '(' . $number_of_comments . ')'; 
                                if($number_of_comments == 1)
                                    {
                                        echo ' kommentar'; 
                                    } 
                                else
                                    {
                                        echo ' kommentarer';
                                    } ?> 
                            </a>
                        </nav>
                    </div> <!-- Closing post-content column -->
                </div> <!-- Closing row for post-->
            </article> <!-- Closing article (works as wrapper for post-row) -->
        <?php endif; ?>
    <?php endfor; ?>  <!-- Ends loop -->

    <?php     
    /* Message if there is no posts */
    if (empty($posts)){
        echo 
            '<div class="no_post">' . 
            'Tyvärr finns det inga inlägg på den här sidan än...' . '<br>' .
            '<a href="/millhouseblog/www/?page=createpost">' . 'Klicka här för att bli först med att skriva ett inlägg' . '</a>' .
            '</div>';
    } 