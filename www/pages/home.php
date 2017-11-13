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
            
        require 'pages/loginform.php';
        //if false/not loggedin dont show blog-posts
        exit();
        
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
      //spara $user_id. loopa igenom user tabell och hämta ut name FROM user där $userid == $userid och lagra i $user_name.
      $user_id = $post[$keys[$i]]['userid'];
            //ska göras till funktion
            $statement = $pdo->prepare("SELECT username FROM user WHERE userid = '$user_id'");
            $statement->execute();
            $userinfo = $statement->fetch(PDO::FETCH_ASSOC);
            $username = $userinfo['username'];
            //slut på hämta username


      //join comments och postid. lagra i array ..??
      //$number_of_comments = count() på arrayen comments som man hämta ut förra.
      ?>
      <article class="">
      <header class=””>
          <!--<meta>kategorierna som meta???-->
          <h2 class=””><?=$post[$keys[$i]]['title'];?></h2>
          <time class=""><?=$post[$keys[$i]]['date'];?></time> 
          <span>Categories</span>
          <span class="">$number_of_comments</span> 
          <span class=""><?=$username?></span>
      </header>
      <p class=””><?=$post[$keys[$i]]['text'];?></p>
      <nav class=””><a href="">Läs hela inlägget.. skicka värde postid?</a></nav>
          <article class=””>(comment)</article>    
  </article>
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
