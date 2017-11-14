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
$statement = $pdo->prepare("SELECT * FROM post ORDER by 'date' DESC");
  $statement->execute();
  $post = $statement->fetchAll(PDO::FETCH_ASSOC);
  $keys = array_keys($post);
?>

  <h1>Senaste blogginläggen</h1>
  ::::just nu displayas inte dom senaste av någon anledning..<br>
  koden ska städas upp....:P tex göra funktion av hämta username i loopen..

<?php
//LOOPING OUT THE POSTS THROUGH $post
//en liten detalj: hur ska man göra ifall det endast skulle finnas mindre än 5 inlägg inte skrivs ut felmeddelande "unknown offset..."
  for($i=0; $i<5; $i++){
      $user_id = $post[$keys[$i]]['userid'];
      $post_id = $post[$keys[$i]]['postid'];
            //ska göras till funktion
            //hämta ut username FROM user där $userid == $userid och lagra i $user_name.
            $statement = $pdo->prepare("SELECT username FROM user WHERE userid = '$user_id'");
            $statement->execute();
            $userinfo = $statement->fetch(PDO::FETCH_ASSOC);
            $username = $userinfo['username'];
<<<<<<< HEAD
            //slut på hämta username


      //join comments och postid. lagra i array ..??
=======

            //hämta ut comments som har detta post_id genom INNER JOIN
            //lagra i array och loopa ut nedanför post
            //här vill jag även få ut användarnament fr user genom comment-tabell
            $statement = $pdo->prepare("SELECT 'comment', 'userid', 'date', 'commentid' FROM comment INNER JOIN post ON comment.postid = $post_id");
            $statement->execute();
            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $fetch_comment = $comments['comment'];
            $number_of_comments = count($comments);


            //räkna array och lagra i number_comments

            
>>>>>>> a473844ff27cc9806104c2986bfd21b93813683e
      //$number_of_comments = count() på arrayen comments som man hämta ut förra.
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
      <p class=””><?=$post[$keys[$i]]['text'];?></p>
<<<<<<< HEAD
      <nav class=””><a href="">Läs hela inlägget.. skicka värde postid?</a></nav>
          <article class=””>(comment)</article>    
  </article>
=======
      <nav class=””><a href="/millhouseblog/www/?page=post&id=<?= $post_id ?>">Läs hela inlägget...</a>
          <a href="/millhouseblog/www/?page=post&id=<?= $post_id ?>">Kommentera</a>
          </nav>

          <article class=””>
              
          </article>    

>>>>>>> a473844ff27cc9806104c2986bfd21b93813683e
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
