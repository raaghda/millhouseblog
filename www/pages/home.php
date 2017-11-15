<?php
require 'parts/database.php';
require 'parts/functions.php';

        /*------     IF ISSET = IF USER IS LOGGED IN     ------*/

        if(isset($_SESSION["user"])){

            echo '<h1>' . "Welcome " . $_SESSION["user"]["username"] . '!' . '</h1>';
            echo '<h2>' . "THIS IS THE HOMEPAGE" . '</h2>';
        
    /*------     EVERYTHING THAT HAPPENS BEFORE ELSE, IS IF USER LOGGED IN    ------*/
    
        } else {
        
            /*------     LOG OUT MESSAGE BELOW, AND LOGIN-FORM IF NOT LOGGED IN     ------*/

            if(isset($_GET['logout'])){
                echo $_GET['logout'];
            }
            
            if(isset($_GET['expired'])){
                echo $_GET['expired'];
            }
        }

//FETCH POSTS
//MAYBE PUT THIS IN PARTS...? AS FETCH_POST T.EX..
$statement = $pdo->prepare("SELECT * FROM post ORDER by date DESC");
$statement->execute();
$post = $statement->fetchAll(PDO::FETCH_ASSOC);
$keys = array_keys($post);

 for($i=0; $i<5; $i++){
    $user_id = $post[$keys[$i]]['userid'];
    $post_id = $post[$keys[$i]]['postid'];
    $category_id = $post[$keys[$i]]['categoryid'];

    $category_name = get_row_with_input('name', 'category', 'categoryid', $category_id);
    $username = get_row_with_input('username', 'user', 'userid', $user_id);

    $number_of_comments = count_comments($post_id);


    //LOOPING OUT THE POSTS
    ?>  
      <article class="">
      <header class=””>
          <!--<meta>kategorierna som meta???-->
          <h2 class=””><?=$post[$keys[$i]]['title'];?></h2>
          <time class=""><?=$post[$keys[$i]]['date'];?></time> 
          <span class=""><?=$category_name?></span>
          <span class=""><?= $number_of_comments ?></span> 
          <span class=""><?= $username?></span>
      </header>
      <p><?=$post[$keys[$i]]['text'];?></p>

        <nav class=””><a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Läs hela inlägget..</a>
          <a href="/millhouseblog/www/?page=viewpost&id=<?= $post_id ?>">Kommentera</a>
        </nav>   
  </article><!--/post article-->
  --------------< hr >--------------
  <?php } 
  
  require 'components/sidebar.php';
  ?>


<!--Blogpost skeleton
<article class="">
<header class=””>
<meta kategorierna som meta???
<h2 class=””>titel</h2>
<time class="">date</time> 
<span>Categories</span>
<span class="">number comments</span> 
<span class="">user</span>
</header>
<p class=””>post text häär</p>
<footer class=””>
<nav class=””>link to more comments</nav>
</footer>
<article class=””>(comment)</article>    
</article>
-->
