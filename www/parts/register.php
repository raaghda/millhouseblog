<!--------- REG-FORM WITH MESSAGE --------> 
      
<?php
       
    /* UNVALID DETAILS MESSAGE BELOW */
       
    if(isset($_GET['nouser'])){
        echo $_GET['nouser'];
    }

    /* UNVALID PASSWORD MESSAGE BELOW */

    if(isset($_GET['notValid'])){
        echo $_GET['notValid'];
    }
    
?>
       
<form action="adduser.php" method="post">
    <input type="name" name="name" placeholder="Ditt namn">
    <input type="email" name="email" placeholder="E-post">
    <input type="username" name="username" placeholder="Användarnamn">
    <input type="password" name="password" placeholder="Lösenord">
    <input type="password" name="validPassword" placeholder="Bekräfta lösenord">
    <input type="submit" value="Registrera">
</form>
      
<a href="http://localhost:8888/millhouseblog/www/index.php">Gå tillbaka till login</a>
     
<!------------ REG-FORM ENDS ------------>