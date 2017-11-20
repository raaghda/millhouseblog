<div class="col-12 sidebar">

    <aside>
        <h3>Kategorier</h3>
        <ul class="categories_in_sidebar">
            <li>
                <a href="/millhouseblog/www/?page=category&categoryid=1">
                Solglasögon</a>
            </li>
            <li>
                <a href="/millhouseblog/www/?page=category&categoryid=2">
                    Klockor</a>
            </li>
            <li>
                <a href="/millhouseblog/www/?page=category&categoryid=3">
                    Inredning</a>
            </li>
            <li>
                <a href="/millhouseblog/www/?page=category&categoryid=4">
                    Lifestyle</a>
            </li>
        </ul>

        <h3>Senaste kommentarerna</h3>
        <ul class="comments_in_sidebar">
        <?php
        //loop out from the latest 5 comments: username and postname. link to that post

        //fetch comments from database
        $statement = $pdo->prepare("SELECT * FROM comment ORDER by date DESC");
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        $keys = array_keys($comments);

        for ($i = 0; $i < 5; $i++){
            //store post_id to get post_title
            //store post_id to be able to link to that specific post
            //user_id to getuser_name from user table
            $post_id = $comments[$keys[$i]]['postid'];
            $user_id = $comments[$keys[$i]]['userid'];

            //use the stored variables to get info from each table
            //FUNCTIONS is in function.php
            $post_title = get_row_with_input("title", "post", "postid", $post_id);
            $username = get_row_with_input("username", "user", "userid", $user_id);
        ?>
            <li>
                <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">
                    <span class="uppercase"><?= $username ?></span> om
                    <span class="uppercase"><?= $post_title ?></span>
                </a>
            </li>

    <?php
    }?>
        </ul>
    </aside>
</div>