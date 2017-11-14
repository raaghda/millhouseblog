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

<div class="background_loginpage">
    <div class="container login">
        <div class="row">
            <div class="col-sm-12">     
                <img src="images/millhouse_logo.svg" width="230px">  
                <form action="/millhouseblog/www/parts/adduser.php" method="post">
                    <input type="name" name="name" placeholder="Ditt namn"></br>
                    <input type="email" name="email" placeholder="E-post"></br>
                    <input type="username" name="username" placeholder="Användarnamn"></br>
                    <input type="password" name="password" placeholder="Lösenord"></br>
                    <input type="password" name="validPassword" placeholder="Bekräfta lösenord"></br>
                    <input type="submit" value="Registrera"></br>
                    <a href="/millhouseblog/www/index.php">Gå tillbaka till login</a>
                </form>
            </div>
        </div>
    </div>
</div>