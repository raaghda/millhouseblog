<?php

    session_start();

    session_destroy();

    /*------    LOGGED OUT MESSAGE WHEN LOGGING OUT, DISPLAYS ON LOGIN-PAGE     ------*/

    $message_logout = urldecode("Du är utloggad!");

    header("Location: /millhouseblog/www/?page=login&logout=".$message_logout);



