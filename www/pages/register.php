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
                    <input type="name" name="name" aria-label="Ditt namn"placeholder="Ditt namn"><br>
                    <input type="email" name="email" aria-label="E-post" placeholder="E-post"><br>
                    <input type="username" name="username" aria-label="Användernamn" placeholder="Användarnamn"><br>
                    <input type="password" name="password" aria-label="Lösenord" placeholder="Lösenord"><br>
                    <input type="password" name="validPassword" aria-label="Bekräfta lösenord" placeholder="Bekräfta lösenord"><br>
                    <input type="submit" value="Registrera"><br>
                    <a href="/millhouseblog/www/index.php">Gå tillbaka till login</a>
                </form>
            </div>
        </div>
    </div>
</div>