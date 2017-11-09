<?php

//Just testing to make sure i can access the database and pull back an individual post.
//http://localhost:8888/millhouseblog/www/components/viewpost.php?postid=2

require '../parts/database.php';


$postid = $_GET["postid"];


$statement = $pdo->prepare("SELECT title, text, date, userid FROM post WHERE postid = :postid");

$statement->execute(array(
            ":postid" => $postid       
        ));



$posts = $statement->fetchALL(PDO::FETCH_ASSOC);

var_dump($posts);


?>