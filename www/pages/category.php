<? require 'parts/database.php';


$categoryid = $_GET["categoryid"];

    $statement = $pdo->prepare(
        "SELECT userid, title, date, text, category.name as category_name FROM post INNER JOIN category ON post.categoryid = category.categoryid WHERE post.categoryid = :categoryid" 
    );

    $statement->execute(array(
        ":categoryid" => $categoryid
    ));

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($statement->errorInfo());
    


foreach($posts as $postinfo){
        //var_dump($postinfo);
        echo $postinfo["title"] . '<br />' . 
             $postinfo["category_name"]  . '<br />' . 
             $postinfo["date"] . '<br />' . 
             $postinfo["text"] . '<br />' . '<br />';
   }

if (empty($posts)){
    echo 'There are no posts in this category.';
}