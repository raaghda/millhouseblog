<?php
require 'parts/database.php';
require 'parts/functions.php';
require 'parts/fetch_posts.php';
 
//if statement checking if there is a session message (parts/deletepost.php)
//if true, display message
display_notification();
?>

<!-- FEED WRAPPER - WRAPS ENTIRE HOME, POSTS AND SIDEBAR -->
<div class="container-fluid feed_wrapper"> 
    <span class="uppercase">   
        <h1 class="light_spacious">Senaste inläggen</h1>
    </span>

    <!-- Post wrapper, containing all posts-->
    <div class="row">
        <div class="post_wrapper col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1">
        <?php
        //PAGINATION
        
        //set $limit as the number of posts to show per page
        $limit = 5;
        //if a page number has been selected, get that value
        if(isset($_GET['pagination_page']))
            {
                //store it in $page
                $page = $_GET['pagination_page'];
            }
        else
            {
                //else, user landed on home-page and page is 1
                $page = 1;
            }        

        //start limit(=which post to start to get from database) is set by the page number and the $limit of the posts to show
        $start_limit = ($page - 1) * $limit;  

        //selects 5 posts, $start_limit to $limit, depending on which page your on, using(?) pagination.
        $statement = $pdo->prepare("SELECT * FROM post 
            ORDER by date DESC 
            LIMIT $start_limit, $limit");
            $statement->execute();
            $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
            $keys = array_keys($posts);


        //Looping out 5 posts, starting from the latest posts.
        //Information about the author of the post=user.
        //How many comments there is on each post. 
        //Link to each specific post
        for($i=0; $i<count($posts); $i++){
        
        //check if the index $i is less than the total number of posts
        if ($i < count($posts)){
     
     
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
            $post_title = make_string_shorter($posts[$keys[$i]]['title'], 50);

            //count comments of this post
            $number_of_comments = count_comments($post_id);
            
            //LOOPING OUT THE CONTENT OF THE POSTS:
            ?>  
            <article class="single_post_box_in_feed">
                <div class="row">
                    <div class="thumbnail_wrapper col-md-4">
                        <div class="thumbnail">
                            <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">
                            <img src="/millhouseblog/www/postimages/<?=$image?>" 
                            class="post_image_in_feed" alt="<?=$title;?>"></a>
                        </div>
                    </div>

                    <div class="post_content col-md-8">
                        <header>  
                            <span class="uppercase grey"><?=$category_name?></span>
                            <!--<meta>kategorierna som meta???-->
                            <h2 class=”postheading”><a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">
                            <?=$post_title;?></a></h2>
                            <span class="grey">
                                Publicerat 
                            <time>
                                <?= $dt->format('Y-m-d'); ?>
                            </time>
                            av
                            </span>
                            <span class="uppercase grey"><?= $username?></span>
                        </header>

                        <p><?=$post_text?></p>
                        <nav>
                            <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">
                            Läs hela inlägget</a> | 
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
        <?php }} ?>  <!-- Ends loop -->
        
        
       <?  
        
        /* Message if there is no posts in selected month */

        if (empty($posts)){
            echo 
                '<div class="no_post">' . 
                'Tyvärr finns det inga inlägg på den här sidan än...' . '<br>' .
                '<a href="/millhouseblog/www/?page=createpost">' . 'Klicka här för att bli först med att skriva ett inlägg' . '</a>' .
                '</div>';
        } ?>

    </div> <!-- Closing post_wrapper row -->
    
    <!-- Sidebar -->
    <div class="col-lg-2 d-none d-md-block sidebar">
        <?php require 'components/sidebar.php'; ?>
    </div> <!-- Closing sidebar-->
    
    <!-- Pagination links-->

    <?php
    //diving the total number of posts in db with the limit posts number(=5) per page to get total pages.
    //using ceil so if it has a desicmal its going to be the higher number.
    $total_pages = ceil($number_of_posts_in_db / $limit);
    ?>
    <div class="col-8 offset-md-1 pagination_container">
        <nav>
            <ul class="pagination">
            <?php 
             //looping out page links with id of each page.
            for ($i=1; $i<=$total_pages; $i++){?>
                 <li><a class="page-link" href="/millhouseblog/www/?page=home&pagination_page=<?=$i?>"><?=$i?></a></li>
            <?php } //end for-loop?>
               
            </ul>
        </nav> 
    </div>
</div><!-- Closing entire feed wrapper container-->