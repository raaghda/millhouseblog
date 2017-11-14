<?php session_start();
    require 'database.php';

    $nocomment = urlencode("Fyll i fälten korrekt!");

    if(!isset($_SESSION['loggedIn'])){

    $name = $_POST["name"];
    $email = $_POST["email"];
        
    } else {
        
        $name = $_SESSION["user"]["name"];
        $email = $_SESSION["user"]["email"];
    }

    $comment = $_POST["comment"];
    $postid = $_POST["id"];

    if(!empty($name && $email && $comment) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        $statement = $pdo->prepare("INSERT INTO comment (postid, comment, email, name) VALUES (:postid, :comment, :email, :name)");

        $statement->execute(array(
            ":postid" => $postid,
            ":comment" => $comment,
            ":email" => $email,
            ":name" => $name
        ));
        
        header ("Location: /millhouseblog/www/?page=post&nocomment=Tack för din kommentar!&id=".$postid);
    
 } else {
        
        header ("Location: /millhouseblog/www/?page=post&nocomment=Fyll i fälten korrekt!&id=".$postid);
        
        }