<? require 'parts/database.php'; ?>

<a href="/millhouseblog/www/?page=categories">Gå tillbaka till alla kategorier</a><br><br><br>

<?

$categoryid = $_GET["categoryid"];

    $statement = $pdo->prepare(
        "SELECT userid, title, date, text, category.name as category_name FROM post INNER JOIN category ON post.categoryid = category.categoryid WHERE post.categoryid = :categoryid" 
    );

    $statement->execute(array(
        ":categoryid" => $categoryid
    ));

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    

foreach($posts as $postinfo){
        echo $postinfo["title"] . '<br />' . 
             $postinfo["category_name"]  . '<br />' . 
             $postinfo["date"] . '<br />' . 
             $postinfo["text"] . '<br />' . '<br />';
   }

if (empty($posts)){
    echo 'There are no posts in this category.';
}
