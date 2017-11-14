<?php
session_start();
    
    if (!isset($_SESSION['loginExpire'])) {
        $_SESSION['loginExpire'] = time();
    } else if (time() - $_SESSION['loginExpire'] > 3600) {
        session_destroy();
        
        $expired = urldecode('Du har blivit utloggad, du måste ' . '<a href="?page=loginform">' . 'Logga in' . '</a>' . ' igen!');
        
        header("Location: /millhouseblog/www/?page=home&expired=".$expired);
    }

include 'components/head.php';


    if(isset($_SESSION['loggedIn'])){
        
        $pagename = "home";
        
    } else {
        
        $pagename = "loginform";
        
    }

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