Form

<form action="parts/savepost.php" method="POST">
    <input type="text" name ="title" placeholder="Skriv din titel här"> 
    <textarea name="text" rows="10" cols="30"></textarea>
    
    
    <input type = "checkbox" name="categoryid" value ="1">Solglasögon
    <input type = "checkbox" name="categoryid" value ="2">Klockor
    <input type = "checkbox" name="categoryid" value ="3">Inredning
    <input type = "checkbox" name="categoryid" value ="4">Lifestyle
    <input type = "checkbox" name="categoryid" value ="5">Övrigt
     
    
    <input type="submit" value="Publicera"> <!--'Publicera' matches wireframe-->
</form>

<?php

var_dump($_SESSION["user"]["userid"]);


?>

//text area, html option dropdown för kategorier.
