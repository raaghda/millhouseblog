<?php
session_start();
require 'database.php';

//var_dump($_SESSION);

$post_id = $_POST['post_id'];

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare("SELECT userid FROM post WHERE postid = :postid");
$statement->execute(array(":postid" => $post_id));
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($posts as $post){
    $user_id = $post['userid'];
}

$not_authorized = urlencode("Du är inte behörig att ta bort det här inlägget!");

// if session user isn't the author of the post
if ((int)$_SESSION['user']['userid'] != $user_id){
    //redirect to home page with error message (see above for error message)
    header ("Location: /millhouseblog/www/?page=home&error=".$not_authorized);

}else{

$statement = $pdo->prepare("DELETE FROM comment WHERE postid = :postid");
$statement->execute(array(":postid" => $post_id));
    
//query created to delete the task from the database, which the user has chosen via the form in fetch_all_todos.php   
$statement = $pdo->prepare("DELETE FROM post WHERE postid = :postid");
$statement->execute(array(":postid" => $post_id));
    

    


//redirected to user's profile
header ("Location: /millhouseblog/www/?page=profile");

}
    

    
