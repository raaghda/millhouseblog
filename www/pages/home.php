<?php
require 'parts/database.php';
require 'parts/functions.php';
?>

<div class="container landingpage">
        <div class="row">
            <div class="col-lg-9">
<?php
//Looping out the 5 latest posts from posts table.
//Information about the author of the post=user.
//How many comments there is on each post. 
//Link to each specific post

//FETCH POSTS
//MAYBE PUT THIS IN PARTS...? AS FETCH_POST T.EX..
$statement = $pdo->prepare("SELECT * FROM post ORDER by date DESC");
$statement->execute();
$post = $statement->fetchAll(PDO::FETCH_ASSOC);
$keys = array_keys($post);

 for($i=0; $i<5; $i++){
    //storing user_id to get to get user_name from user-table
    $user_id = $post[$keys[$i]]['userid'];
    //storing post_id for the link to view the specific post
    //storing post_id to count how many comments it has, stored in number_of_comments
    $post_id = $post[$keys[$i]]['postid'];
    //storing category_id to get the category_name from category table
    $category_id = $post[$keys[$i]]['categoryid'];

    //FUNCTIONS is in functions.php
    $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);
    $username = get_row_with_input('username', 'user', 'userid', $user_id);

    $number_of_comments = count_comments($post_id);

    //fixes the empty post. if theres not enough post to be looped out.
    if($post_id == NULL)
    {  
      //Don't display "empty" posts if posts < 5
      break;
    }
    else
    { 
    //LOOPING OUT THE POSTS
    ?>  
      <article class="post">
      <header>  
            <span class="uppercase grey"><?=$category_name?></span>
        <!--<meta>kategorierna som meta???-->
        <h2 class=”postheading”><?=$post[$keys[$i]]['title'];?></h2>
        <time class="grey"><?=$post[$keys[$i]]['date'];?></time>
        <span class="uppercase grey"><?= $username?></span>

        <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>#comments"><?= $number_of_comments ?> kommentarer</a><!--added comments anchor-->
      </header>
      <p><?=$post[$keys[$i]]['text'];?></p>

        <nav class=””>
            <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget</a>
        </nav>   
  </article><!--/post article-->
  <?php } 
}?>

    </div><!--/col-md-8-->

    <div class="col-lg-3 sidebar hidden-xs-down">
        <?php
        require 'components/sidebar.php';
        ?>
    </div><!--/sidebar-->

  </div><!--/row-->
</div><!--/container-->