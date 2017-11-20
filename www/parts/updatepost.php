<?php

require 'database.php';


//if the POSTtitle, POSTcreatedBy and POSTid are true (input into field)
if (isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["image"])){                                      

    
$statement = $pdo->prepare(
"UPDATE post SET title = :title, text = :text, image = :image WHERE id = :id");

$statement->execute(array(":title" => $_POST["title"],":text" => $_POST["text"],":image" => $_POST["image"], ":id" => $_POST["id"]));   
    
}