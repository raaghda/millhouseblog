<form action="parts/addcomment.php" method="post">
    
    <? if(!isset($_SESSION['loggedIn'])){ ?>
       
       <input type="text" name="name" placeholder="Namn">
       <input type="text" name="email" placeholder="Email">
        
    <?  } else {}  ?>
    
    <input type="text" name="comment" placeholder="Kommentar">
    <input type="submit" name="addcomment" value="Skicka">
    
</form>