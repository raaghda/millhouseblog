<?php
session_start();
require 'database.php';
require 'notifyfunctions.php';

//var_dump($_SESSION);

$post_id = $_POST['post_id'];

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare("SELECT userid FROM post WHERE postid = :postid");
$statement->execute(array(":postid" => $post_id));
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($posts as $post){
    $user_id = $post['userid'];
}


// if session user isn't the author of the post AND the session user's role is not admin
if ((int)$_SESSION['user']['userid'] != $user_id && $_SESSION['user']['role']!='admin'){
    
    //redirect to home page with error message (see above for error message)
    $_SESSION['notify']['message'] = 'Du är inte behörig att ta bort det här inlägget!'; 
    $_SESSION['notify']['type'] = 'danger'; 
    header ("Location: /millhouseblog/www/?page=home");
     
      
}else{

$statement = $pdo->prepare("DELETE FROM comment WHERE postid = :postid");
$statement->execute(array(":postid" => $post_id));
    
//query created to delete the task from the database, which the user has chosen via the form in fetch_all_todos.php   
$statement = $pdo->prepare("DELETE FROM post WHERE postid = :postid");
$statement->execute(array(":postid" => $post_id));
    
//calling notify function to display success+message (see parts/notifyfunctions.php)
notify('success','Your post has been deleted');  


//redirected to user's profile
header ("Location: /millhouseblog/www/?page=profile");

}
    

    
