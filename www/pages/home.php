<?php
require 'parts/database.php';
require 'parts/functions.php';
 
//if statement checking if there is a session message (parts/deletepost.php)
//if true, display message
display_notification();

?>


<div class="container_landingpage"> 
   <div class="wrapper">
    <span class="uppercase">   
        <h1 class="light_spacious">Senaste inläggen:</h1>
    </span>

    <div class="row">
        <div class="post_wrapper col-lg-9">
<?php
//Looping out 5 posts, starting from the latest posts.
//Information about the author of the post=user.
//How many comments there is on each post. 
//Link to each specific post


//PAGINATION
//set $limit as the number of posts to show per page
$limit = 5;
    //if a page number has been selected, get that value
    if(isset($_GET['pagination_page'])){
        //store it in $page
        $page = $_GET['pagination_page'];
    }
        else{
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

 for($i=0; $i<count($posts); $i++){
     
     //if the index $i is less than the total number of posts
     if ($i < count($posts)){
     
     //var_dump(count($keys), count($posts));
     
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

    //if post-text is longer than 500ch, shorten it
    $post_text = make_string_shorter($posts[$keys[$i]]['text'], 150);

    //count comments of this post
    $number_of_comments = count_comments($post_id);

    //LOOPING OUT THE POSTS
    ?>  
      <article class="post">
      <div class="row">
      <div class="thumb_wrap col-md-4">
      <img src="/millhouseblog/www/postimages/<?=$image?>" class="img-thumbnail" alt="<?=$title;?>">
      </div>
      <div class="post_content col-md-8">
      <header>  
            <span class="uppercase grey"><?=$category_name?></span>
        <!--<meta>kategorierna som meta???-->
        <h2 class=”postheading”><?=$posts[$keys[$i]]['title'];?></h2>
        
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

        <nav class=””>
            <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">Läs hela inlägget</a> | 
            <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments">
        <?= '(' . $number_of_comments . ')'; 
        
        if($number_of_comments == 1){
            echo ' kommentar'; } else{
            echo ' kommentarer';
        } ?> 
        </a><!--added comments anchor-->
        </nav>
        </div>
        </div>   
  </article><!--/post article-->
  <?php }} 
?>  <nav>
        <ul class="pagination">
            <li><a class="page-link" href="/millhouseblog/www/?page=home&pagination_page=1">1</a></li>
            <li><a class="page-link" href="/millhouseblog/www/?page=home&pagination_page=2">2</a></li>
            <li><a class="page-link" href="/millhouseblog/www/?page=home&pagination_page=3">3</a></li>
            <li><a class="page-link" href="/millhouseblog/www/?page=home&pagination_page=4">4</a></li>
        </ul>
    </nav> 
    </div><!--/col-md-9-->

    <div class="col-lg-3 sidebar hidden-xs-down">
        <?php
        require 'components/sidebar.php';
        ?>
    </div><!--/sidebar-->

  </div><!--/row-->
  </div>
</div><!--/container-->