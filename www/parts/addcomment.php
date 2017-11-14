<?php session_start();
    require 'database.php';

    if(!isset($_SESSION['loggedIn'])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $nocomment = urlencode("Fyll i fälten korrekt!");
        
    } else {
        
        $name = $_SESSION["user"]["name"];
        $email = $_SESSION["user"]["email"];
        
        //var_dump($_SESSION["user"]["name"]);
        //var_dump($_SESSION["user"]["email"]);
    }

    $comment = $_POST["comment"];
    $postid = $_POST["id"];

    //var_dump($_POST["id"]);

    if(!empty($name && $email && $comment)){
        
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