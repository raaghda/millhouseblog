<div class="sidebar col-12">
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

    <h3>Arkiv</h3>
    <ul>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=01">
            Januari</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=02">
            Februari</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=03">
            Mars</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=04">
            April</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=05">
            Maj</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=06">
            Juni</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=07">
            Juli</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=08">
            Augusti</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=09">
            September</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=10">
            Oktober</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=11">
            November</a>
        </li>
        <li>
            <a href="/millhouseblog/www/?page=displaymonth&month=12">
            December</a>
        </li>
    </ul>

            <h3>Senaste kommentarerna</h3>
            <ul class="comments_in_sidebar">
            <?php //loop out from the latest 5 comments: username and postname. link to that post
            
            //loop out from the latest 5 comments: username and postname. link to that post

            //fetch comments from database
            $statement = $pdo->prepare("SELECT * FROM comment ORDER by date DESC");
            $statement->execute();
            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $keys = array_keys($comments);

            for ($i = 0; $i < 5; $i++){
                //store post_id to get post_title
                //store post_id to be able to link to that specific post
                $post_id = $comments[$keys[$i]]['postid'];

                //if who made a comment wasnt logged in and therefore has no userid..
                //..get email from comment table
                //else store user_id and get username from user table
                if ($comments[$keys[$i]]['userid'] == NULL){
                    $username = $comments[$keys[$i]]['name'];
                } else {
                    $user_id = $comments[$keys[$i]]['userid'];
                    $username = get_row_with_input("username", "user", "userid", $user_id);
                    }

                //use the stored variables to get info from each table
                //FUNCTIONS is in function.php
                $post_title = get_row_with_input("title", "post", "postid", $post_id);
               
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
