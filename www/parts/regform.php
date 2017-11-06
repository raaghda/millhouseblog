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
   
<form action="http://localhost:8888/millhouseblog/parts/login.php" method="post">
    <input type="username" name ="username" placeholder="Username"> 
    <input type="password" name ="password" placeholder="Password">
    <input type="submit" value="Login">
</form>
    
<a href="http://localhost:8888/millhouseblog/parts/register.php">Register</a>

<!-------- LOGIN-FORM ENDS ---------->