<?php
    session_start();
    require 'parts/notifyfunctions.php';   
    

    // Sets the Session to expire after 60min
    if (!isset($_SESSION['loginExpire'])) {
        $_SESSION['loginExpire'] = time();
    } else if (time() - $_SESSION['loginExpire'] > 3600) {
        session_destroy();
        
        $expired = urldecode('Du har blivit utloggad');
        
        header("Location: /millhouseblog/www/?page=loginform&expired=".$expired);
    }

    include 'components/head.php';

    // Takes you to loginpage, instead of home if logged out
    if(isset($_SESSION['loggedIn'])){
        $pagename = "home";
    } else {
        $pagename = "loginform";
    }

    //Gets the choosen page, if files not exist, you get 404
    if(isset($_GET['page'])) {
        $pagename = $_GET ['page'];
    }
    
    if (file_exists("pages/$pagename.php")) {
        include "pages/$pagename.php";
    } else {
        include "pages/404.php";
    }
    
    include 'components/footer.php';
?>