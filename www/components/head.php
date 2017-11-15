<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
       <?
        
        $pagename = $_GET ['page'];
        
        if($pagename == "loginform"){
            echo 'Logga in';
        } else if($pagename == "register"){
            echo 'Registrera dig'; 
        } else if($pagename == "home"){
            echo 'Hem'; 
        } else if($pagename == "categories"){
            echo 'Kategorier';
        } else if($pagename == "faq"){
            echo 'FAQ';
        } else if($pagename == "profile"){
            echo 'Min profil';
        }  
        
        ?>
    </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css" >
</head>
<body>

<header>
    <?php require 'navbar.php'; ?>
</header>

<main>