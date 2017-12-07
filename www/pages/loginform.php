<!-------- LOGIN-FORM WITH MESSAGE ---------->
  
<div class="background_loginpage">
    <div class="container login"> 
        <div class="row">
            <div class="col-12">
                <img src="images/Millhouse_logo.png" id=logo_image width="200px">
                
                <div class="messagebox">
                
                <?php
      
                    /* NEW REG MESSAGE BELOW */

                    if(isset($_GET['newuser'])){
                        echo '<div class="messagebox_success">' . $_GET['newuser'] . '</div>';
                    }

                    /* WRONG PASSWORD MESSAGE BELOW */

                    if(isset($_GET['wrongpass'])){
                        echo '<div class="messagebox_fail">' . $_GET['wrongpass'] . '</div>';
                    }

                    /* LOGOUT MESSAGE BELOW */

                    if(isset($_GET['logout'])){
                        echo '<div class="messagebox_success">' . $_GET['logout'] . '</div>';
                    }

                    /* SESSION EXPIRE MESSAGE BELOW */

                    if(isset($_GET['expired'])){
                        echo '<div class="messagebox_fail">' . $_GET['expired'] . '</div>';
                    }

                ?>
                
                </div>
               
                <form action="/millhouseblog/www/parts/login.php" method="post">

                    <input type="username" name ="username" aria-label="Användarnamn" placeholder="Användarnamn"><br>
                    <input type="password" name ="password" aria-label="Lösenord" placeholder="Lösenord"><br>
                    <input type="submit" aria-label="Logga in" value="Logga in">

                </form>       
                <a href="/millhouseblog/www/?page=register">Bli medlem</a>
                <span class="smallcaps">

                    <a class="continue" href="/millhouseblog/www/?page=home">
                        Eller fortsätt utan konto
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
</div> 