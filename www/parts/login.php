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
    
    /*----- Har gjort echo inloggad bara för att se att den fungera, man ska redirectas i " header (" "); -----*/
    
    
    /* header("    "); */ echo "inloggad";
} else {
    header("Location: /millhouseblog/www/parts/loginform.php/?wrongpass=".$message_wrongpass);
}