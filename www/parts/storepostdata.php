<?php

// Created a session variable $_SESSION['new_post_data'] = $_POST; 
// Placed in savepost.php (see top of page) 
// Created to store data from the createpost form temporarily
// In order to keep data on page if user doesn't fill in all fields correctly
// When error message appears, any previously stored info in fields will remain.
    

    // Checks if POST data is set for title field
    if(isset($_SESSION['new_post_data']['title'])) 
    { 
        // If true, assign session title data to $saved_title
        $saved_title = $_SESSION['new_post_data']['title'];
        
    } else {
        
        // Else leave $saved_title empty
        $saved_title='';  
        
    }   
    

    // Checks if POST data is set for text field
    if(isset($_SESSION['new_post_data']['text'])) 
    { 
        // If true, assign session text data to $saved_text
        $saved_text = $_SESSION['new_post_data']['text'];
        
    } else {
        
        // Else leave $saved_text empty
        $saved_text='';  
    }
    
    // Checks if POST data is set for category dropdown
    if(isset($_SESSION['new_post_data']['categoryid'])) 
    { 
        // If true, assign session category data to $saved_kategori
        $saved_category = $_SESSION['new_post_data']['categoryid'];
        
    } else {
        
        $saved_category='';
        
    }
    
    // Unregisters the session variable  
    unset($_SESSION['new_post_data']);

?>