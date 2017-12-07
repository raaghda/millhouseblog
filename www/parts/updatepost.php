<?php

    session_start();

    // Target page variable created to hold part of the URL,
    // enabling redirect on uploadimage.php to return to a specific
    // post on viewpost page.
    $target_page="viewpost&id=".$_POST["postid"];
    require 'database.php';
    require 'notifyfunctions.php';
    require 'uploadimage.php';
    

    //if the POSTtitle, POSTcreatedBy and POSTid are true (input into field)
    if (isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["categoryid"])){  

        //if there is NOT a new file, prepare/execute a query to update post data to database
        if(!isset($fileNameNew)){
            $statement = $pdo->prepare(
                "UPDATE post SET 
                title = :title, 
                text = :text, 
                categoryid = :categoryid 
                WHERE postid = :postid");

            $statement->execute(array(
                ":title" => $_POST["title"],
                ":text" => $_POST["text"],
                ":categoryid" => $_POST["categoryid"], 
                ":postid" => $_POST["postid"]));   

            $post_id = $_POST["postid"];

        //else prepare/execute query to update title, text, catid, image to database (new image = $fileNameNew)
        }else{

            $statement = $pdo->prepare(
                "UPDATE post SET 
                title = :title, 
                text = :text, 
                categoryid = :categoryid, 
                image = :image 
                WHERE postid = :postid");

            $statement->execute(array(
                ":title" => $_POST["title"],
                ":text" => $_POST["text"],
                ":categoryid" => $_POST["categoryid"],
                ":image" => $fileNameNew,
                ":postid" => $_POST["postid"]));   

            $post_id = $_POST["postid"];
        }

        notify('success','Ditt inlägg har blivit uppdaterat!');

    header("Location: /millhouseblog/www/?page=viewpost&id=".$post_id);   
    }