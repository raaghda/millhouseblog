<?php

    require 'database.php';

    $message_newuser = urldecode("Ny användare registrerad!");
    $message_nouser = urldecode("Fyll i alla fält korrekt!");
    $message_notValid = urldecode("Lösenorden stämmer ej!");

    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $validPassword = $_POST["validPassword"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    if($_POST["password"] == $validPassword){

    if(!empty($username && $password && $name && $email)){
        $statement = $pdo->prepare("INSERT INTO user (username, password, name, email) VALUES (:username, :password, :name, :email)");

        $statement->execute(array(
            ":username" => $username,
            ":password" => $password,
            ":name" => $name,
            ":email" => $email
        ));

        header ("Location: /millhouseblog/www/index.php/?newuser=".$message_newuser);

    } else {

        header ("Location: /millhouseblog/www/?page=register");
        
    }} else {
        
        header ("Location: /millhouseblog/www/?page=register");
        
    }

//header ("Location: /millhouseblog/www/parts/register.php/?nouser=".$message_nouser);
//header ("Location: /millhouseblog/www/parts/register.php/?notValid=".$message_notValid);
