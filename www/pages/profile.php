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
<div class="container-fluid admin_header">
     <div clas="row">
        <div class="col-4 offset-4">
                <img src="images/lifestyle.jpg" id=profile_avatar alt="Avatar för användare" class="rounded-circle" width="150px" height="150px">
                <h1> <?php echo $fetched_user["name"]; ?> </h1>
                <p>XX inlägg med XX kommentarer </p>
                <p> Gick med <?php echo $fetched_user["registertime"];?> </p>
        </div>
    </div>
</div>

<div class="container-fluid admin_profile_content">
    <div clas="row">
        <div class="col-xs-10 offset-xs-2 col-sm-10 offset-sm-1 col-lg-8 offset-lg-2">
        <h2> for loop som visar (x5): </h2></br>
        Kategori </br>
        X antal kommentarer </br>
        Datum det är publicerat </br>
        Titel på inlägg </br>
        lorem ipsum </br>
        Läs hela inlägget </br>
        <!-- Lorem ipsum för att testa så columns är rätt -->
        "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
        totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, 
        sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est
        , qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius 
        modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima
         veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea 
         commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse 
         quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
        </div>
    </div>
</div>