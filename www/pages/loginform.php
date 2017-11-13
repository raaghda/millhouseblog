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
<div class="login_container">   
    <img src="images/millhouse_logo.svg" width="200px">
        <form action="/millhouseblog/www/parts/login.php" method="post">
            <input type="username" name ="username" placeholder="Användarnamn"></br>
            <input type="password" name ="password" placeholder="Lösenord"></br>
            <input type="submit" value="Logga in">
        </form>
        
    <a href="/millhouseblog/www/?page=register">Registrera ny användare</a>
</div>

<!-------- LOGIN-FORM ENDS ---------->

<?php include 'components/footer.php'; ?>