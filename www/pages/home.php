<?php
require 'parts/database.php';
require 'parts/functions.php';
require 'parts/fetch_posts.php';
?>

<div class="container landingpage">
<<<<<<< HEAD
=======


<?php
    //error message from deletepost.php - if user tries to delete post they haven't created.
   if (isset($_GET['error'])){?>
    
    <p style="color: red; text-align:center"><?= $_GET['error'];?></p>
    
    <?php
    }
    ?>   
    
>>>>>>> master
<h1 class="heading">Senaste inläggen</h1>
        <div class="row">
            <div class="col-lg-9">
<?php
//Looping out the 5 latest posts from posts table.
//Information about the author of the post=user.
//How many comments there is on each post. 
//Link to each specific post

//$post is in fetch_posts                
            
 for($i=0; $i<5; $i++){
     
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
    $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);
    $username = get_row_with_input('username', 'user', 'userid', $user_id);
    $user_email = get_row_with_input('email', 'user', 'userid', $user_id);
    $date = $posts[$keys[$i]]['date'];
    $dt = new datetime($date);

    //if post-text is longer than 500ch, shorten it
    $post_text = make_string_shorter($posts[$keys[$i]]['text'], 500);

    //count comments of this post
    $number_of_comments = count_comments($post_id);

    //LOOPING OUT THE POSTS
    ?>  
      <article class="post">
      <header>  
            <span class="uppercase grey"><?=$category_name?></span>
        <!--<meta>kategorierna som meta???-->
        <h2 class=”postheading”><?=$posts[$keys[$i]]['title'];?></h2>
        <time>
            <?= $dt->format('Y-m-d'); ?>
        </time>
        <span class="uppercase grey"><?= $username?></span>
        <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments">
        <?= '(' . $number_of_comments . ')'; 
        
        if($number_of_comments == 1){
            echo ' kommentar'; } else{
            echo ' kommentarer';
        } ?> 
        </a><!--added comments anchor-->

      </header>
      <p><?=$post_text?></p>

        <nav class=””>
            <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
        </nav>   
  </article><!--/post article-->
  <?php }} 
?>

    </div><!--/col-md-8-->

    <div class="col-lg-3 sidebar hidden-xs-down">
        <?php
        require 'components/sidebar.php';
        ?>
    </div><!--/sidebar-->

  </div><!--/row-->
</div><!--/container-->