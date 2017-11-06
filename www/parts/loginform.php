<!-------- LOGIN-FORM WITH MESSAGE ---------->
  
<?php
      
    /* NEW REG MESSAGE BELOW */

    if(isset($_GET['newuser'])){
        echo $_GET['newuser'];
    }
      
    /* WRONG PASSWORD MESSAGE BELOW */
      
    if(isset($_GET['wrongpass'])){
        echo $_GET['wrongpass'];
    }
    
?>
   
<form action="parts/login.php" method="post">
    <input type="username" name ="username" placeholder="Användarnamn"> 
    <input type="password" name ="password" placeholder="Lösenord">
    <input type="submit" value="Logga in">
</form>
    
<a href="/millhouseblog/www/parts/register.php">Registrera ny användare</a>

<!-------- LOGIN-FORM ENDS ---------->