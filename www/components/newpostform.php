Form

<form action="parts/savepost.php" method="POST">
    <input type="text" name ="title" placeholder="Skriv din titel här"> 
    <textarea name="text" rows="10" cols="30"></textarea>
    
    <input type = "text" name="categoryid" value="1"> <!--temporary value until linked to table-->
    
    
    <input type="submit" value="Publicera"> <!--'Publicera' matches wireframe-->
</form>

<?php

var_dump($_SESSION["user"]["userid"]);


?>

//text area, html option dropdown för kategorier.
