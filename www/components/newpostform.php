<?php
require './parts/database.php';

    $statement = $pdo->prepare(
        "SELECT * FROM category" 
    );

    $statement->execute();

    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
   

   <form action="parts/savepost.php" method="POST">
    <input type="text" name ="title" placeholder="Skriv din titel här"> 
    <textarea name="text" rows="10" cols="30"></textarea>

    
    <!--added drop-down instead of checkbox as user can only choose one category at a time at the moment-->
    <select required name="categoryid">   
      
      <?php
        foreach ($categories as $category){
        ?>
           <option value="<?=$category['categoryid'];?>"><?=$category['name'];?></option> 
        <?php
        }
        ?>
    
    </select>
     
    
    <input type="submit" value="Publicera"> <!--'Publicera' matches wireframe-->
</form>

<?php

//var_dump($_SESSION["user"]["userid"]);


?>


