<?php
session_start();
require 'database.php';

$comment_id = $_GET['comment_id'];
$post_id = $_GET["post_id"];

$statement = $pdo->prepare("DELETE FROM `comment` WHERE `comment`.`commentid` = :comment_id");

$statement->execute(array(
":comment_id" => $comment_id
));

header("Location: /millhouseblog/www/?page=viewpost&id=$post_id");