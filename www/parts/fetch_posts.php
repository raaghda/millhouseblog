<?php
require 'database.php';
//alla posts, ordered by latest posts
//GÖRA: FUNKTION FETCH_ALL_POSTS
function fetch_all_posts(){
    require 'database.php';
    $statement = $pdo->prepare("SELECT * FROM post ORDER by date DESC");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function fetch_posts_from_start_to_limit($start_limit, $limit){  
    require 'database.php';      
    $statement = $pdo->prepare("SELECT * FROM post 
                                ORDER by date DESC 
                                LIMIT $start_limit, $limit");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function get_number_of_posts(){
    require 'database.php';
    $statement = $pdo->prepare("SELECT COUNT(postid) as count
                                FROM post");
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

$number_of_posts_in_db = get_number_of_posts();


//$number_of_posts_in_db = get_number_of_posts();

//$keys = array_keys($posts);