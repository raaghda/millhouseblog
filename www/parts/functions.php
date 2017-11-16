  <?php
  require 'parts/database.php';

function get_row_with_input($row_name, $table_name, $compare_row, $input){
    require 'parts/database.php';
    $statement = $pdo->prepare("SELECT $row_name FROM $table_name WHERE $compare_row = $input");
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result["$row_name"];
}         

function count_comments($post_id){
    require 'parts/database.php';
    $statement = $pdo->prepare("SELECT * FROM comment INNER JOIN post ON comment.postid = post.postid WHERE comment.postid = $post_id");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $number_of_comments = count($comments);
    return $number_of_comments;
}

