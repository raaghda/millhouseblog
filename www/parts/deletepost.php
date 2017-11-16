<?php
require 'database.php';

$post_id = $_POST['post_id'];

//Error needs to be handled
if (!($post_id)){
    echo 'This file cannot be deleted';
}else{
    
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//query created to delete the task from the database, which the user has chosen via the form in fetch_all_todos.php   
$statement = $pdo->prepare("DELETE FROM post WHERE postid = :postid");
$statement->execute(array(":postid" => $post_id,));

//Should the user be redirected to the homepage?
header ("Location: /millhouseblog/www/?page=home");


}   
    

    
