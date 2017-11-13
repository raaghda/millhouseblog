<?php
session_start();
    
    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 10) {
        session_destroy();
        header("Location: /millhouseblog/www/?page=home");
        //echo 'Du har blivit utloggad, du måste <a href="?page=home">Logga in</a> igen';
        
    }

include 'components/head.php';
    
    $pagename = "loginform";
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