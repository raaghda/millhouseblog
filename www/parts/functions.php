  <?php
  require 'parts/database.php';

  
  //get a specific value from a row in a table using an id to compare with the id's in the table
  //You have a userid. You want to get the persons username. 
  //so you compare the userid with all the userid's in the user table.
  //Select username from user where userid = userid. Where $input is the userid you have to compare.
function get_row_with_input($row_name, $table_name, $compare_row_name, $input){
    require 'parts/database.php';
    $statement = $pdo->prepare("SELECT $row_name FROM $table_name WHERE $compare_row_name = $input");
    $statement->execute();  
    //Store it in an array.
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //get the row_name from the array. Fex username
    return $result["$row_name"];
}         


//get all comments made on a specific post using post_id
function count_comments($post_id){
    require 'parts/database.php';
    $statement = $pdo->prepare("SELECT * FROM comment INNER JOIN post ON comment.postid = post.postid WHERE comment.postid = $post_id");
    $statement->execute();
    //store it in an array
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    //counting the number of objects in the array using count function = the number of comments
    return count($comments);
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

