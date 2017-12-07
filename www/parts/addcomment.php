<?php session_start();
    require 'database.php';
    require 'notifyfunctions.php';

    $nocomment = urlencode("Fyll i fälten korrekt!");
    $userid = null;

    if(!isset($_SESSION['loggedIn'])){

        $name = $_POST["name"];
        $email = $_POST["email"];
        
    } else {
        
        $name = $_SESSION["user"]["name"];
        $email = $_SESSION["user"]["email"];
        $userid = $_SESSION["user"]["userid"];
    }

    $comment = $_POST["comment"];
    $postid = $_POST["id"];

    if(!empty($name && $email && $comment) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        $statement = $pdo->prepare("INSERT INTO comment (userid, postid, comment, email, name) VALUES (:userid, :postid, :comment, :email, :name)");

        $statement->execute(array(
            ":userid" => $userid,
            ":postid" => $postid,
            ":comment" => $comment,
            ":email" => $email,
            ":name" => $name
        ));
        
        notify ('success','Tack för din kommentar!');
        header ("Location: /millhouseblog/www/?page=viewpost&id=".$postid);
    
    } else {
        notify ('warning','Fyll i fälten korrekt!');
        header ("Location: /millhouseblog/www/?page=viewpost&id=".$postid);
        
    }