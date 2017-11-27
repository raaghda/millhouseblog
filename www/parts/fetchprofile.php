
<?php
require 'database.php';

//THIS IS WHERE WE FETCH ALL THE INFORMATION USED FOR THE PROFILE PAGE


// Defines the id of logged in user
$userid = $_SESSION["user"]["userid"];


//Fetches info about the logged in user from database
$statement = $pdo->prepare(
    "SELECT username, userid, email, name, role, registertime 
    FROM user 
    WHERE userid = :userid");
//We save this info in an array called fetched user
$statement->execute(array(
":userid" => $userid
));
$fetched_user = $statement->fetch(PDO::FETCH_ASSOC);


//Declares empty variables to be used later in profile, 
//This way we avoid them being "undefined" before the actual value is set
$posts_by_user = '';
$comments_by_user = '';
$comments_on_users_posts = '';


//Variable for formating date and time correctly
$date = $fetched_user["registertime"];
$dt = new datetime($date);


//SQL-query fetching total number of POSTS made by user
$statement = $pdo->prepare(
    "SELECT COUNT(post.postid) 
    AS total 
    FROM post INNER JOIN user 
    ON post.userid = user.userid 
    WHERE user.userid = $userid");
$statement->execute(array(
    ":total" => $posts_by_user
    ));
$posts_by_user = $statement->fetch(PDO::FETCH_ASSOC);


//SQL-query fetching total number of COMMENTS made by user
$statement = $pdo->prepare(
    "SELECT COUNT(comment.commentid) 
    AS total 
    FROM comment INNER JOIN user 
    ON comment.userid = user.userid 
    WHERE user.userid = $userid");
$statement->execute(array(
    ":total" => $comments_by_user
    ));
$comments_by_user = $statement->fetch(PDO::FETCH_ASSOC);


//SQL-query fetching total number of recived COMMENTS on posts MADE BY USER
//(If the user has commented on it's own post, this comment will also count)
$statement = $pdo->prepare(
    "SELECT COUNT(comment.commentid)
    AS total
    FROM comment
    LEFT JOIN post
    ON comment.postid = post.postid
    WHERE post.userid = $userid");
$statement->execute(array(
":total" => $comments_on_users_posts
));
$comments_on_users_posts = $statement->fetch(PDO::FETCH_ASSOC);


//SQL-query fetching posts made by user, and details about that post
//Saves everything into an array ($post) with the help of array using array_keys-function
$statement = $pdo->prepare("SELECT * 
  FROM post 
  WHERE userid = $userid 
  ORDER by date DESC");
$statement->execute();
$post = $statement->fetchAll(PDO::FETCH_ASSOC);
$keys = array_keys($post);


//SQL-query fetching comments made by user, and details about that comment
//Saves everything into an array ($comments) with the help of array using array_keys-function
$statement = $pdo->prepare("SELECT * FROM comment WHERE userid = $userid ORDER by date DESC");
$statement->execute();
$comments = $statement->fetchAll(PDO::FETCH_ASSOC);
$keys = array_keys($comments);