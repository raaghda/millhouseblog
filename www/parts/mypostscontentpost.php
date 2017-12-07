<?php

//Loop displaying (max) five latest posts made by user
for($i=0; $i<5; $i++):

    //Checks if the index $i is less than the total number of posts
    if ($i < count($posts)):
        //Fetches information from array in "parts/fetchprofile.php" 
        //Puts this into new variables for each post in loop
        $post_id = $posts[$keys[$i]]['postid'];
        $title = $posts[$keys[$i]]['title'];
        $image = $posts[$keys[$i]]['image'];
        $category_id = $posts[$keys[$i]]['categoryid'];
        $post_date = $posts[$keys[$i]]['date']; 
        $dt = new datetime($post_date); 

        //Fetches category name from a row in a table,
        // using an id to compare with the id's in the table
        $category_name = get_column_with_input('name', 'category', 'categoryid', $category_id);

        //Function for counting the total comments on each post displayed in the loop
        $number_of_comments = count_comments($post_id);

        //Puts post text into new variable, and uses a function for 
        //limiting the number of characters to be displayed to 300
        $post_text = make_string_shorter($posts[$keys[$i]]['text'], 150); ?>

        <article class="single_post_in_feed">
            <div class="row">
                <div class="thumbnail_wrapper col-md-4">
                    <div class="thumbnail">
                        <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">
                        <img src="/millhouseblog/www/postimages/<?=$image?>" 
                        class="post_image" alt="<?=$title;?>"></a>
                    </div>
                </div>

                <div class="post_content col-md-8">
                    <span class="uppercase grey"> <?=$category_name?> </span>
                    <h2 class=”postheading”><a href="/millhouseblog/www/?page=viewpost&id=
                    <?=$post_id?>">
                    <?=$title;?></a></h2>
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
                    </br>
                    <p id="post_paragraph"><?=$post_text?></p>
                    
                    <div class="row post_actions">
                        <a href="/millhouseblog/www/?page=viewpost&id=
                        <?= $post_id ?>">Läs hela inlägget</a>
                        <span class="lightblue indent_left indent_right">|</span>
                        <form action="./?page=editpost" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post_id ?>">
                            <input type="submit" ID="edit_post_via_profile" 
                            name="edit" value="Redigera inlägg">
                        <span class="lightblue indent_left indent_right">|</span>
                        </form>
                        <form action="../www/parts/deletepost.php" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post_id ?>">
                            <input type="submit" ID="delete_post_via_profile" name="delete" 
                            value="Ta bort" onclick="return confirm('Är du säker att du 
                            vill ta bort inlägget?')">   
                        </form>
                    </div> 
                </div> <!-- Closing post-content col 8-md -->
            </div> <!-- Closing row for post-->
        </article> <!-- Closing article -->
    <?php endif; ?>
<?php endfor; ?>  <!-- Ends loop -->

<?php
/* Message if there is no posts in selected month */
if (empty($posts)):
    echo 
        '<div class="no_post">' . 
        'Tyvärr finns det inga inlägg på den här sidan än...' . '<br>' .
        '<a href="/millhouseblog/www/?page=createpost">' . 
        'Klicka här för att bli först med att skriva ett inlägg' . '</a>' .
        '</div>';
endif; ?>