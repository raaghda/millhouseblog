<?php
require 'parts/database.php';

// 1. VI BEHÖVER HÄMTA USERID (KOPIERA SAMMA LOGIK SOM VI HAR GET PARAMETERN PAGE OCH ÄNDRA DEN TILL USERID)

if(isset($_SESSION["user"])) {
    $userid = $_SESSION["user"]["userid"];


// 2. HÄMTA EN ANVÄNDARE FRÅN DATABASEN SOM HAR DET USERID SOM VI FICK FRÅN GET-PARAMETERN (SE KODEN I LOGIN HUR VI HÄMTAR USERINFORMATION FRÅN DATABASEN)

$statement = $pdo->prepare("SELECT username, email, name, role, registertime FROM user WHERE userid = :userid");

$statement->execute(array(
":userid" => $userid
));

$fetched_user = $statement->fetch(PDO::FETCH_ASSOC);

?>

<?php
if ($fetched_user["role"]=="admin"){
    include 'components/newpostform.php';
}

?>


<br><br><strong><?php echo $fetched_user["name"]; ?></strong>
<br><br><strong><?php echo $fetched_user["email"]; ?></strong>
<br><br><i><?php echo $fetched_user["role"]; ?></i>
<br><br>Joined on: <?php echo $fetched_user["registertime"]; 

} else {
    header("Location: /millhouse/www/index.php");
    //echo 'Du måste <a href="?page=home">Logga in</a>';
}?>