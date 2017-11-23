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

//takes in the string you want to shorten and the max-length you want
function make_string_shorter($string, $max_length){
    $string = strip_tags($string);

    //checking if string is longer than max-length
    if (strlen($string) > $max_length) {
    
        //make the string no more than max-length
        $shortened_string = substr($string, 0, $max_length);
        
        //cut the string in after a word and add ... after string
        $string = substr($shortened_string, 0, strrpos($shortened_string, ' ')).'...'; 
    }
    return $string;}

