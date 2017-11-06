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
        $statement = $pdo->prepare("INSERT INTO users (username, password, name, email) VALUES (:username, :password, :name, :email)");

        $statement->execute(array(
            ":username" => $username,
            ":password" => $password,
            ":name" => $name,
            ":email" => $email
        ));

        header ("Location: http://localhost:8888/millhouse/index.php/?newuser=".$message_newuser);

    } else {

        header ("Location: http://localhost:8888/millhouse/parts/register.php/?nouser=".$message_nouser);
        
    }} else {
        header ("Location: http://localhost:8888/millhouse/parts/register.php/?notValid=".$message_notValid);
    }
