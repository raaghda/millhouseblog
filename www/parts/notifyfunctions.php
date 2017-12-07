<?php

    //ref. https://www.youtube.com/watch?v=gxRUPovQVN4&feature=youtu.be
    //https://v4-alpha.getbootstrap.com/components/alerts/
    //ALERTS x4: 'success' , 'info' , 'warning', 'danger'



    //FUNCTION: sets notification, e.g. notify('danger', 'Fyll i fälten korrekt!');
    function notify($type, $message)
    {

        $_SESSION['notify']['type'] = $type;
        $_SESSION['notify']['message'] = $message;

    }


    //FUNCTION: automates the type of alert displayed to user
    function display_notification()
    {
        //if session notify is set
        if(isset($_SESSION['notify']))
           {
                //set the type variable to the type of notification
               $type = $_SESSION['notify']['type'];
                //set the message variable to the message of notification
               $message = $_SESSION['notify']['message'];

                //create $html variable to equal bootstrap string for alerts
                //insert the message & type variables into the string to pull in corresponding css
               $html = '<div class="alert alert-'.$type.' role="alert"><strong>'.$message.'</strong></div>';

               echo $html;  

                //unset session (removes message when page is refreshed)
               unset($_SESSION['notify']);
           }
    }

?>