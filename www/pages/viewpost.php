<?php

//Just testing to make sure i can access the database and pull back an individual post.
//http://localhost:8888/millhouseblog/www/components/viewpost.php?postid=2

require 'parts/database.php';


$postid = $_GET["id"];
//$postid = 9836;


$statement = $pdo->prepare("SELECT title, text, date, userid FROM post WHERE postid = :postid");

$statement->execute(array(
            ":postid" => $postid       
        ));



$posts = $statement->fetchALL(PDO::FETCH_ASSOC);

foreach($posts as $postinfo){
        echo $postinfo["title"] . '<br />' . 
             $postinfo["date"] . '<br />' . 
             $postinfo["text"] . '<br />' . '<br />';
   }



if(isset($_GET['nocomment'])){
    echo $_GET['nocomment'];
            }

?>

<form action="parts/addcomment.php" method="post">
    
    <? if(!isset($_SESSION['loggedIn'])){ ?>
       
       <input type="text" name="name" placeholder="Namn">
       <input type="text" name="email" placeholder="Email">
        
    <?  } else {} ?>
    
    <input type="hidden" name="id" value="<?= $postid ?>">
    <input type="text" name="comment" placeholder="Kommentar">
    <input type="submit" name="addcomment" value="Skicka">
    
</form>

