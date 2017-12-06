<?php
//Loops out latest comments made by user (max five) 
for ($i = 0; $i < 5; $i++):

    //SQL-query fetching comments made by user, and details about that comment
    //Saves everything into an array ($comments) with the help of array using array_keys-function
    $statement = $pdo->prepare("SELECT * FROM comment 
                                WHERE userid = $userid 
                                ORDER by date DESC");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($comments);
            
    //Checks if the index $i is less than the total number of posts
    if ($i < count($comments)):
        //Fetches information from array in "parts/fetchprofile.php" 
        //Puts this into new variables for each comment in loop
        $post_id = $comments[$keys[$i]]['postid'];
        $comment_date = $comments[$keys[$i]]['date'];
        $comment_id = $comments[$keys[$i]]['commentid'];
        $comment = $comments[$keys[$i]]['comment'];
        $date = $comments[$keys[$i]]['date'];
        $dt = new datetime($date); 

        //Fetches post-title from a row in a table,
        // using an id to compare with the id's in the table
        $post_title = get_column_with_input("title", "post", "postid", $post_id);

        //Puts comment text into new variable, and uses a function for 
        //limiting the number of characters to be displayed to 200
        $comment_text = make_string_shorter($comments[$keys[$i]]['comment'], 200); ?>  
        
        <!-- Comment-content -->
        <article class="comments_displayed_on_profile_page">
            <span class="grey">
                Du kommenterade på
                <a href="/millhouseblog/www/?page=viewpost&id=
                <?= $post_id ?>"><?= '"' . $post_title . '"' ?> </a>
                <time class="grey"> den
                <?= $dt->format('Y-m-d'); ?>
                </time>
                <p id="comment_text"> <?=$comment_text;?> </p>
            </span>
        </article> 
    <?php endif; ?>
<?php endfor; ?>