<?php
session_start();

    include 'components/head.php';

    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 60) {
        
        session_destroy();
        //header("Location: /millhouse/www/?page=home");
        echo 'Du har blivit utloggad, du måste <a href="?page=home">Logga in</a> igen';
        //Includes footer when user is logged out due to session ending
        include 'components/footer.php';
        exit();
    } 

    $pagename = "home";
    if(isset($_GET['page'])) {
        $pagename = $_GET ['page'];
    }
    
    if (file_exists("pages/$pagename.php")) {
        echo '<br />';
        include "pages/$pagename.php";
    } else {
        include "pages/404.php";
    }
    
    include 'components/footer.php';
?>