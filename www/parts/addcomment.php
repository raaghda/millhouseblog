<?php session_start();
    require 'database.php';

    if(!isset($_SESSION['loggedIn'])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $nocomment = urlencode("Fyll i fälten korrekt!");
        
        var_dump($_POST["name"]);
        var_dump($_POST["email"]);
        
    } else {
        
        $name = $_SESSION["user"]["name"];
        $name = $_SESSION["user"]["email"];
        
        var_dump($_SESSION["user"]["name"]);
        var_dump($_SESSION["user"]["email"]);
    }

    $comment = $_POST["comment"];

    var_dump($_POST["comment"]);

    if(!empty($username && $password && $name && $email)){
        
        $statement = $pdo->prepare("INSERT INTO user (username, password, name, email) VALUES (:username, :password, :name, :email)");

        $statement->execute(array(
            ":username" => $username,
            ":password" => $password,
            ":name" => $name,
            ":email" => $email
        )); 
    
        } else {
        
        echo "inga kommentarer!";
        
        }
        
        */
        