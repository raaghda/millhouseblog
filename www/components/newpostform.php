Form

<form action="parts/savepost.php" method="POST">
    <input type="text" name ="title" placeholder="Skriv din titel här"> 
    <textarea name="text" rows="10" cols="30"></textarea>
    
   <!--
    <input type = "checkbox" name="categoryid" value ="1">Solglasögon
    <input type = "checkbox" name="categoryid" value ="2">Klockor
    <input type = "checkbox" name="categoryid" value ="3">Inredning
    <input type = "checkbox" name="categoryid" value ="4">Lifestyle
    <input type = "checkbox" name="categoryid" value ="5">Övrigt
    -->
    
    <!--added drop-down instead of checkbox as user can only choose one category at a time at the moment-->
    <select name="categoryid">
      <option selected="" >Välja en kategori</option>    
      <option value="1" >Solglasögon</option>
      <option value="2" >Klockor</option>
      <option value="3" >Inredning</option>
      <option value="4">Lifestyle</option>
      <option value="5" >Övrigt</option>
    </select>
     
    
    <input type="submit" value="Publicera"> <!--'Publicera' matches wireframe-->
</form>

<?php

var_dump($_SESSION["user"]["userid"]);


?>

//text area, html option dropdown för kategorier.
