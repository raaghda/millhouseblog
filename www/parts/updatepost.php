<?php

require 'database.php';


//if the POSTtitle, POSTcreatedBy and POSTid are true (input into field)
if (isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["categoryid"])){                                      

    
$statement = $pdo->prepare(
"UPDATE post SET title = :title, text = :text, categoryid = :categoryid WHERE postid = :postid");

$statement->execute(array(":title" => $_POST["title"],":text" => $_POST["text"],":categoryid" => $_POST["categoryid"], ":postid" => $_POST["postid"]));   
    
    
$post_id = $_POST["postid"];
 
        
header("Location: /millhouseblog/www/?page=viewpost&id=".$post_id);
    
}