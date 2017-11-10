
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="?page=home">
            <img src="images/millhouse_icon.svg" width="40px" alt="Logga för Millhouse">
        </a>
        <!-- Hamburger-menu -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsedNav" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>  
    </div> <!-- Closing navbar header -->

    <div class="collapse navbar-collapse" id="collapsedNav">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="?page=home">Start</a></li>
        <li>
            <!-- Displays "My Profile" if user is logged in -->
            <?php
                if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) 
                    {
                        echo '<a href="?page=profile">Min profil</a>';
                    }
            ?>    
        </li>
        <li><a href="?page=categories">Kategorier</a></li>
        <li><a href="?page=faq">FAQ</a></li>
        <li>
            <!-- Displays "Log in to logged out/unregistered user, and vice versa -->
            <?php
                if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
                    echo '<a href="parts/logout.php">Logga ut</a>';
                }
                else{
                    echo '<a href="?page=home">Logga in</a>';   
                }
            ?>
        </li>
      </ul> <!--Closing ul navbar-right -->
    </div> <!--Closing navbar collapse -->
  </div> <!-- Closing container fluid -->
</nav> <!-- Closing Navbar-->
