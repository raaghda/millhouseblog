<?php
require 'database.php';

//fetch all posts from database
function fetch_all_posts(){
    require 'database.php';
    $statement = $pdo->prepare("SELECT * FROM post ORDER by date DESC");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


//fetch posts within the span of $start_limit --to-- ($start_limit + $limit).
//example: posts 5 - 15. $start_limit=5, $limit=10
function fetch_posts_from_start_to_limit($start_limit, $limit){  
    require 'database.php';      
    $statement = $pdo->prepare("SELECT * FROM post 
                                ORDER by date DESC 
                                LIMIT $start_limit, $limit");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


//get how many posts there is in db. for use in pagination, to set maximum pages, depending on the limit...
//example, you show 10(=$limit) posts per page. there is 120 posts, 120/10 = 12 pages.
function get_number_of_posts(){
    require 'database.php';
    $statement = $pdo->prepare("SELECT COUNT(postid) as count
                                FROM post");
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

$number_of_posts_in_db = get_number_of_posts();


//$keys = array_keys($posts);