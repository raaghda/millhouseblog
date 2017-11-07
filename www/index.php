<? session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <title>Millhouse</title>

</head>
<body>

<?php
    $pagename = "home";
    if(isset($_GET['page'])) {
        $pagename = $_GET ['page'];
    }
    
    if (file_exists("pages/$pagename.php")) {
        include "pages/$pagename.php";
    } else {
        include "pages/404.php";
    }
?>

</body>
</html>