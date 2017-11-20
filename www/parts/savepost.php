<?php
session_start();
require 'database.php';
include 'uploadimage.php';


if (isset($_POST["title"],$_POST["text"],$_POST["categoryid"])){
    
$title = $_POST["title"];
$text = $_POST["text"];
$categoryid = $_POST["categoryid"];
$image = $fileNameNew;   
    
//userid comes from the session, not the form
$userid = $_SESSION["user"]["userid"];
    
    
    if ($title == '' || $text == ''){
            //reports error, if error occurs (temporary ugly error message - needs handling!)
            echo 'failed';
            //want to go back to create post page here
    }else{
        
        $statement = $pdo->prepare("INSERT INTO post (title, text, userid, categoryid, image) VALUES (:title, :text, :userid, :categoryid, :image)");
        
        //if a statement is successful, it returns as TRUE (stack overflow)
        //created variable $result to test if insert succeeded
        $result = $statement->execute(array(
            ":title" => $title,
            ":text" => $text,
            ":userid" => $userid,
            ":categoryid" => $categoryid,
            ":image" => $image
        ));

        $last_id = $pdo->lastInsertId();
 
        
        header("Location: /millhouseblog/www/?page=viewpost&id=".$last_id);
       
        //print_r($statement->errorInfo());
             
    }   
}



    

//https://www.w3schools.com/php/php_mysql_insert.asp
//http://php.net/manual/en/pdo.lastinsertid.php

?>

