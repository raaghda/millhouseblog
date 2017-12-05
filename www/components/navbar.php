<!-- NAVBAR USING BOOTSTRAP 4.0 -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="?page=home">
        <img src="images/millhouse_icon.svg" width="50px" height="50px" alt="Logga för Millhouse">
    </a>

<!-- Hamburger menu, shows collapsed menu when toggled  -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburgerMenu" aria-controls="hamburgerMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

<!-- Main navbar, connecting to collapsed-toggle with id  --> 
    <div class="collapse navbar-collapse justify-content-end" id="hamburgerMenu">
        <ul class="navbar-nav justify-content-end">
            <li>
                <a href="?page=home">Hem</a>
            </li>

            <!-- Displays "My Profile" if user is logged in -->
            <?php
            
                if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true){
                    echo '<li><a href="?page=profile">Min profil</a></li>';
                }
            
            ?> 
            <li>
                <a href="?page=categories">Kategorier</a>
            </li>
            <li>
                <a href="?page=about">Om oss</a>
            </li>
            <li>

            <!-- Displays "Log in to logged out/unregistered user, and vice versa -->
            <?php
                
                if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
                    echo '<a href="parts/logout.php">Logga ut</a>';
                } else{
                    echo '<a href="?page=loginform">Logga in</a>';   
                }
                
            ?>

            </li>
        </ul>
    </div>
</nav>