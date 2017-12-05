<div class="background_loginpage">
    <div class="container login">
        <div class="row">
            <div class="col-sm-12">     
                <img src="images/Millhouse_logo.png" id=logo_image width="200px">
                <div class="messagebox">
                    
                    <!--------- REG-FORM WITH MESSAGE --------> 
      
                    <?php

                        /* UNVALID DETAILS MESSAGE BELOW */

                        if(isset($_GET['nouser'])){
                            echo '<div class="messagebox_fail">' . $_GET['nouser'] . '</div>';
                        }

                        /* UNVALID PASSWORD MESSAGE BELOW */

                        if(isset($_GET['notValid'])){
                            echo '<div class="messagebox_fail">' . $_GET['notValid'] . '</div>';
                        }

                    ?>
                     
                </div>  
                <form action="/millhouseblog/www/parts/adduser.php" method="post">
                    <input type="name" name="name" placeholder="Ditt namn"><br>
                    <input type="email" name="email" placeholder="E-post"><br>
                    <input type="username" name="username" placeholder="Användarnamn"><br>
                    <input type="password" name="password" placeholder="Lösenord"><br>
                    <input type="password" name="validPassword" placeholder="Bekräfta lösenord"><br>
                    <input type="submit" value="Registrera"><br>
                    <a href="/millhouseblog/www/index.php">Gå tillbaka till login</a>
                </form>
            </div>
        </div>
    </div>
</div>