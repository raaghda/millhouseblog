<?php

    $pagename = "home";

    if(isset($_GET['page'])) {
        $pagename = $_GET ['page'];
    }    

    if($pagename == "loginform"){
        echo 'Logga in';
    } else if($pagename == "register"){
        echo 'Registrera dig'; 
    } else if($pagename == "home"){
        echo 'Hem'; 
    } else if($pagename == "categories"){
        echo 'Kategorier';
    } else if($pagename == "sortbycategory"){

        /* Naming the title after choosen category */
        if($_GET["categoryid"] == 1){
            echo 'Solglasögon';
        } else if($_GET["categoryid"] == 2){
            echo 'Klockor';
        } else if($_GET["categoryid"] == 3){
            echo 'Inredning';
        } else if($_GET["categoryid"] == 4){
            echo 'Övrigt';
        }

    } else if($pagename == "displaymonth"){

        /*Naming the title after choosen month*/
        if($_GET["month"] == 01){
            echo 'Januari';
        } else if($_GET["month"] == 2){
            echo 'Februari';
        } else if($_GET["month"] == 3){
            echo 'Mars';
        } else if($_GET["month"] == 4){
            echo 'April';
        } else if($_GET["month"] == 5){
            echo 'Maj';
        } else if($_GET["month"] == 6){
            echo 'Juni';
        } else if($_GET["month"] == 7){
            echo 'Juli';
        } else if($_GET["month"] == 8){
            echo 'Augusti';
        } else if($_GET["month"] == 9){
            echo 'September';
        } else if($_GET["month"] == 10){
            echo 'Oktober';
        } else if($_GET["month"] == 11){
            echo 'November';
        } else if($_GET["month"] == 12){
            echo 'December';
        }

    } else if($pagename == "about"){
        echo 'Om Millhouse';
    } else if($pagename == "profile"){
        echo 'Min profil';
    } else if($pagename == "404"){
        echo '404';
    } else if($pagename == "viewpost"){
        echo 'Inlägg';
    } else if($pagename == "createpost"){
        echo 'Skapa inlägg';
    } else if($pagename == "editpost"){
        echo 'Redigera inlägg';
    } else if($pagename == "myposts"){
        echo 'Mina inlägg';
    } else {
        echo '404';
    }