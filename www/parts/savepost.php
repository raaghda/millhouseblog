<?php
session_start();
require 'database.php';


if (isset($_POST["title"],$_POST["text"],$_POST["categoryid"])){
    
$title = $_POST["title"];
$text = $_POST["text"];
$categoryid = $_POST["categoryid"];
    
//userid comes from the session, not the form
$userid = $_SESSION["user"]["userid"];
    
    
    if ($title == '' || $text == ''){
            //reports error, if error occurs (temporary ugly error message - needs handling!)
            echo 'failed';
            
    }else{
        
        $statement = $pdo->prepare("INSERT INTO post (title, text, userid, categoryid) VALUES (:title, :text, :userid, :categoryid)");
        
        //if a statement is successful, it returns as TRUE (stack overflow)
        //created variable $result to test if insert succeeded
        $result = $statement->execute(array(
            ":title" => $title,
            ":text" => $text,
            ":userid" => $userid,
            ":categoryid" => $categoryid 
        ));
        
   
        echo 'TITLE: <br>' . $title;
        echo '<br>';
        echo '<br>';
        echo 'TEXT: <br>' . $text;
        echo '<br>';
        echo '<br>';
        echo 'CATEGORY <br>'. $categoryid;
        echo '<br>';
        echo '<br>';
        
        require '../components/viewpost.php';
        
        //print_r($statement->errorInfo());
        
    }   
}
    

//https://www.w3schools.com/php/php_mysql_insert.asp

?>

