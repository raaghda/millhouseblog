<?php
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
    
//FETCH POSTS FROM 
//PUT THIS IN PARTS...? AS FETCH_POST T.EX..
require 'parts/database.php';
$statement = $pdo->prepare("SELECT * FROM post ORDER by date DESC");
  $statement->execute();
  $post = $statement->fetchAll(PDO::FETCH_ASSOC);
  $keys = array_keys($post);

//LOOPING OUT THE POSTS THROUGH $post
//en liten detalj: hur ska man göra ifall det endast skulle finnas mindre än 5 inlägg inte skrivs ut felmeddelande "unknown offset..."
  for($i=0; $i<5; $i++){
      $user_id = $post[$keys[$i]]['userid'];
      $post_id = $post[$keys[$i]]['postid'];
            //ska göras till funktion
            //hämta ut username FROM user där $userid == $userid och lagra i $user_name.
            //GÖRA FUNKTION
            $statement = $pdo->prepare("SELECT username FROM user WHERE userid = '$user_id'");
            $statement->execute();
            $userinfo = $statement->fetch(PDO::FETCH_ASSOC);
            $username = $userinfo['username'];

            //hämta ut comments som har detta post_id genom INNER JOIN
            //lagra i array och loopa ut nedanför post
            $statement = $pdo->prepare("SELECT * FROM comment INNER JOIN post ON comment.postid = post.postid WHERE comment.postid = $post_id");
            $statement->execute();
            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $number_of_comments = count($comments);
      ?>
      
      <article class="">
      <header class=””>
          <!--<meta>kategorierna som meta???-->
          <h2 class=””><?=$post[$keys[$i]]['title'];?></h2>
          <time class=""><?=$post[$keys[$i]]['date'];?></time> 
          <span>Categories</span>
          <span class=""><?= $number_of_comments ?></span> 
          <span class=""><?= $username ?></span>
      </header>
      <p><?=$post[$keys[$i]]['text'];?></p>

        <nav class=””><a href="/millhouseblog/www/?page=post&id=<?= $post_id ?>">Läs hela inlägget...</a>
          <a href="/millhouseblog/www/?page=post&id=<?= $post_id ?>">Kommentera</a>
        </nav>

      <?php
        //looping out comments
        foreach($comments as $comment_info){
            $user_id = $comment_info['userid'];
            //göra funktion
            $statement = $pdo->prepare("SELECT username FROM user WHERE userid = '$user_id'");
            $statement->execute();
            $userinfo = $statement->fetch(PDO::FETCH_ASSOC);
            $username = $userinfo['username'];
            ?>
          <article class=””> 
            <header class="">
                <time class=""><?=$comment_info['date']?></time> 
                <span>av <?=$username?></span>
            </header>
            <p class=""><?=$comment_info["comment"]?></p>    
            <?php
            }
            ?>
           </article><!--/comment article-->    
  </article><!--/blogpost article-->
  --------------< hr >--------------
  <?php } 
  
  require 'components/sidebar.php';
  ?>


<!--Blogpost skeleton to be looped out
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
