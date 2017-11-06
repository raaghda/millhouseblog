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
    <input type="email" name="email" placeholder="Epost">
    <input type="username" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="validPassword" placeholder="Valid Password">
    <input type="submit" value="Register">
</form>
      
<a href="http://localhost:8888/millhouse/index.php">Gå tillbaka till login</a>
     
<!------------ REG-FORM ENDS ------------>