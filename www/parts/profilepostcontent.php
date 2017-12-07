<?php
    //Loop displaying (max) five latest posts made by user
    for($i=0; $i<5; $i++):

        //SQL-query fetching posts made by user, and details about that post
        //Saves everything into an array ($post) with the help of array using array_keys-function
        $statement = $pdo->prepare("SELECT * 
                                    FROM post 
                                    WHERE userid = $userid 
                                    ORDER by date DESC");
        $statement->execute();
        $post = $statement->fetchAll(PDO::FETCH_ASSOC);
        $keys = array_keys($post);

        //Checks if the index $i is less than the total number of posts
        if ($i < count($post)):
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
            $post_text = make_string_shorter($post[$keys[$i]]['text'], 300); ?>

            <!-- Post-content -->
            <article class="posts_displayed_on_profile_page">
                <span class="uppercase grey"> <?=$category_name?> </span>
                <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">
                <h2> <?=$post[$keys[$i]]['title'];?> </h2></a>
                <span class=grey>
                    <time> Publicerat  
                        <?= $dt->format('Y-m-d'); ?>
                    </time>
                </span>
                <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments">
                <?php echo '(' . $number_of_comments . ')'; 

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
        <?php endif; ?> 
    <?php endfor; ?>