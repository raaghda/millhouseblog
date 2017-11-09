<?php
session_start();

    include 'components/head.php';

    $pagename = "home";
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