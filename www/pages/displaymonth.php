<? require 'parts/database.php';

    var_dump($_GET["month"]);

    $month = $_GET["month"];

$statement = $pdo->prepare(
"SELECT * FROM post WHERE MONTH($month)"
);

 $statement->execute(array(
        ":month" => $month
    ));

$months = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($months);

?>