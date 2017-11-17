<?php

    require 'database.php';

    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $validPassword = $_POST["validPassword"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $notValid = urlencode("Lösenorden stämmer ej!");
    $nouser = urldecode("Fyll i alla fält korrekt!");
    $newuser = urldecode("Ny användare registrerad!");

    if($_POST["password"] == $validPassword){

    if(!empty($username && $password && $name && $email)){
        $statement = $pdo->prepare("INSERT INTO user (username, password, name, email) VALUES (:username, :password, :name, :email)");

        $statement->execute(array(
            ":username" => $username,
            ":password" => $password,
            ":name" => $name,
            ":email" => $email
        ));

        header ("Location: /millhouseblog/www/?page=loginform&newuser=".$newuser);

    } else {

        header ("Location: /millhouseblog/www/?page=register&nouser=".$nouser);
        
    }} else {
        
        header ("Location: /millhouseblog/www/?page=register&notValid=".$notValid);
        
    }
