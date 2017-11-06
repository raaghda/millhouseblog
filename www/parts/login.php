<?php

session_start();

require 'database.php';

$username = $_POST["username"];
$password = $_POST["password"];
$message_wrongpass = urldecode("Skriv korrekt användarnamn & lösenord!");

$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");

$statement->execute(array(
":username" => $username
));

$fetched_user = $statement->fetch(PDO::FETCH_ASSOC);

if(password_verify($password, $fetched_user["password"])){
    header("    ");
} else {
    header("Location: http://localhost:8888/millhouse/regform.php/?wrongpass=".$message_wrongpass);
}