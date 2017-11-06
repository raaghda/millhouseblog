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
    header("    ");
} else {
    header("Location: http://localhost:8888/millhouseblog/www/parts/loginform.php/?wrongpass=".$message_wrongpass);
}