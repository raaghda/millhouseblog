<div>
    <a href="?page=home">Start</a>
    <a href="?page=categories">Kategorier</a>
    <a href="?page=faq">FAQ</a>
    
    <?php
        session_start();
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            echo '<a href="?page=logout">Logga ut</a>';
        }
        else{
            echo '<a href="?page=login">Logga in</a>';   
        }
    ?>
</div>