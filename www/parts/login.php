<?php

    session_start();

    require 'database.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $message_wrongpass = urldecode("Fel lösenord eller användarnamn");

    $statement = $pdo->prepare("SELECT * FROM user WHERE username = :username");

    $statement->execute(array(
    ":username" => $username
    ));

    $fetched_user = $statement->fetch(PDO::FETCH_ASSOC);

    if(password_verify($password, $fetched_user["password"])){

        $_SESSION["user"] = $fetched_user;
        $_SESSION["loggedIn"] = true;
        header("Location: /millhouseblog/www/?page=home&success=true");

    } else {
        header("Location: /millhouseblog/www/?page=loginform&wrongpass=".$message_wrongpass);
    }