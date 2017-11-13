<? require 'database.php';


$categoryid = $_POST["categoryid"];

    $statement = $pdo->prepare(
        "SELECT userid, title, date, text FROM post WHERE categoryid = :categoryid"
    );

    $statement->execute(array(
        ":categoryid" => $categoryid
    ));

    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($categories as $categoryinfo){
        echo $categoryinfo["title"] . '<br />' . 
             $categoryinfo["userid"]  . '<br />' . 
             $categoryinfo["date"] . '<br />' . 
             $categoryinfo["text"];
   }