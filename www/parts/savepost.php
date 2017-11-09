<?php

require 'database.php';


if (isset($_POST["title"], $_POST["text"], $_POST["categoryid"])){


$title = $_POST["title"];
$text = $_POST["text"];
$categoryid = $_POST["categoryid"];
    
//userid comes from the session, not the form
$userid = $_SESSION["user"]["userid"];

//if (!empty($title && $body_text)){


$statement = $pdo->prepare("INSERT INTO post (title, text, userid, categoryid) VALUES (:title, :text, :userid, :categoryid)");

    //if a statement is successful, it returns as TRUE (stack overflow)
    //created variable $result to test if insert succeeded
    $result = $statement->execute(array(
            ":title" => $title,
            ":text" => $text,
            ":userid" => $userid,
            ":categoryid" => $categoryid          
        ));
    
    
    if ($result == false){
        //reports error, if error occurs (temporary ugly error message - needs handling!)
        print_r($statement->errorInfo());
    }else{
        echo 'Success!';
    }
}



//https://www.w3schools.com/php/php_mysql_insert.asp

?>

