<?php
require 'parts/database.php';

// 1. VI BEHÖVER HÄMTA USERID (KOPIERA SAMMA LOGIK SOM VI HAR GET PARAMETERN PAGE OCH ÄNDRA DEN TILL USERID)

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
<div class="container-fluid admin_wrapper_image">
     <div clas="row">
        <div class="col-4 offset-4">
                <img src="images/lifestyle.jpg" id=profile_avatar alt="Avatar för användare" class="rounded-circle" width="150px" height="150px">
                <h1> <?php echo $fetched_user["name"]; ?> </h1>
                <p>XX inlägg med XX kommentarer </p>
                <p> Joined on: <?php echo $fetched_user["registertime"];?> </p>
        </div>
    </div>
</div>




<div class="container-fluid admin_profile_content">
    <div clas="row">
        <div class="col-8 offset-4">

<h2> for loop som visar 5 st: </h2></br>
    Kategori </br>
    X antal kommentarer </br>
    Datum det är publicerat </br>
    Titel på inlägg </br>
    lorem ipsum </br>
    Läs hela inlägget </br>

        

        </div>
    </div>
</div>

<div class=""