<?php
require './parts/database.php';


    $statement = $pdo->prepare(
        "SELECT * FROM category" 
    );

    $statement->execute();

    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

$i = 0;
   

$query = "";    
if(isset($_GET['query'])) {
    $query=$_GET['query'];
}    
?>
<div class="sidebar col-12">
    <aside>
<div class="row">
    <div class="col-12 aside_category">
        <h3>Sök</h3>
        <form method="get">
            <input type="hidden" name="page" value="home">
            <input type="text" name="query" value="<?php echo $query; ?>" placeholder="Sök i bloggen">
            <input type="submit" value="Sök">
        </form>        
    </div>
    <div class="col-12 aside_category">

    <h3>Kategorier</h3>
    <ul class="categories_in_sidebar">
        
        <?
        foreach($categories as $category){ 

        $i = $i+1;
        ?>
    
         <li>
            <a href="/millhouseblog/www/?page=category&categoryid=<?= $i; ?>">
            <?= $category["name"];?> </a>
        </li>
<? } ?>
   
    </ul>
        </div>
    </div>

    <div class="col-12 aside_months">
    
    <div class="sidebar_underline"></div>
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
          
          <div class="sidebar_underline"></div>
           </div>
           <div class="col-12 aside_latest">

            <h3>Aktivitet</h3>
            <ul class="comments_in_sidebar">
            <?php //loop out from the latest 5 comments: username and postname. link to that post
            
            //loop out from the latest 5 comments: username and postname. link to that post

            //fetch comments from database
            $statement = $pdo->prepare("SELECT * FROM comment ORDER by date DESC");
            $statement->execute();
            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $keys = array_keys($comments);

            for ($i = 0; $i < 8; $i++):
                if ($i < count($comments)){
                //store post_id to get post_title
                //store post_id to be able to link to that specific post
                $post_id = $comments[$keys[$i]]['postid'];

                //if who made a comment wasnt logged in and therefore has no userid..
                //..get email from comment table
                //else store user_id and get username from user table
                if ($comments[$keys[$i]]['userid'] == NULL){
                    $username = $comments[$keys[$i]]['email'];
                } else {
                    $user_id = $comments[$keys[$i]]['userid'];
                    $username = get_column_with_input("username", "user", "userid", $user_id);
                    }

                //use the stored variables to get info from each table
                //FUNCTIONS is in function.php
                $post_title = get_column_with_input("title", "post", "postid", $post_id);
               
            ?>
                <li>
                    <span class=grey><?= $username ?> kommenterade </span>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>"><?= $post_title ?></a>
                </li>

        <?php
        } endfor; ?>
            </ul>
            </div>
        </div>
        </aside>
    </div>
