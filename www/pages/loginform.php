<!-------- LOGIN-FORM WITH MESSAGE ---------->
  

<div class="background_loginpage">
    <div class="container login"> 
        <div class="row">
            <div class="col-12">
                <img src="images/millhouse_logo.svg" width="230px">
                
                <div class="messagebox">
                
                <?php
      
                /* NEW REG MESSAGE BELOW */

                if(isset($_GET['newuser'])){
                    echo $_GET['newuser'];
                }

                /* WRONG PASSWORD MESSAGE BELOW */

                if(isset($_GET['wrongpass'])){
                    echo $_GET['wrongpass'];
                }
                
                /* LOGOUT MESSAGE BELOW */

                if(isset($_GET['logout'])){
                    echo $_GET['logout'];
                }
                
                /* SESSION EXPIRE MESSAGE BELOW */

                if(isset($_GET['expired'])){
                    echo $_GET['expired'];
                }

                ?>
                
                </div>
               
                <form action="/millhouseblog/www/parts/login.php" method="post">
                    <input type="username" name ="username" placeholder="Användarnamn"></br>
                    <input type="password" name ="password" placeholder="Lösenord"></br>
                    <input type="submit" value="Logga in">
                </form>       
                <a href="/millhouseblog/www/?page=register">Registrera ny användare</a>
            </div>
        </div>
    </div>
</div> 