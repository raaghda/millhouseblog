<?php
require 'database.php';

//alla posts, ordered by latest posts
$statement = $pdo->prepare("SELECT * FROM post ORDER by date DESC");
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
$keys = array_keys($posts);

$number_of_posts_in_db = count($posts);