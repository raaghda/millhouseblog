<?php
include "components/footer.php";
?>


    <!-- <a href="?page=home">Start</a>
    <a href="?page=categories">Kategorier</a>
    <a href="?page=faq">FAQ</a> -->
    <?php
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            echo '<a href="parts/logout.php">Logga ut</a>';
        }
        else{
            echo '<a href="?page=home">Logga in</a>';   
        }
    ?>


<nav class="navbar navbar-default">

    <div class="container-fluid">
  
        <div class="navbar-header">
            <a class="navbar-brand" href="?page=home"><img alt="Millhouse Icon" src="..."></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapsed" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
        <div class="collapse navbar-collapse" id="navbar-collapsed">
      
        
            
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="?page=home">Hem</a></li>
                    <li><a href="?page=categories">Kategorier</a></li>
                    <li><a href="?page=faq">FAQ</a></li>
            </ul>
            </div><!--Closing navbar collapse -->
        </div>
</div>
</nav>



 <!-- Exempel från elexir -->

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.html"><img src="images/elexir_logga_vit.svg" alt="Elexir logga"></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <li><a href="index.html">HEM</a>
        <li><a href="_products.html" id=menulink-one>VÅRA JUICER</a>
        <li><a href="_about.html" id=menulink-two><span style="text-decoration: underline">OM ELEXIR</span></a>
          <li><a href="_contact.html" id=menulink-three>BUTIK</a>
      </ul>
    </div><!--Closing navbar collapse -->
  </div><!-- Closing container fluid -->
</nav><!--Closing navbar-->

