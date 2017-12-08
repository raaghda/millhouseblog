<?php
    /*GET PAGE NUMBER TO KNOW WHICH POSTS TO LOOP OUT*/
    //if a user has selected a specific page number
    if(isset($_GET['pagination_page']))
    {
        //store it in $page_number
        $page_number = $_GET['pagination_page'];
    }
    else
    {
        //else, user landed on home-page and page is 1
        $page_number = 1;
    }        

    //set $limit as the number of posts to show per page
    //this will also set the $start_limit
    $limit = 5;

    //start limit(=which post to start to get from database) is automatically set by the page number and the $limit of the posts to show
    //example: the page selected is 2, there is a limit of 10 posts per page, so it should start on the 11th post.
    //= the post with index 10. 
    //10 = (2 - 1) * 10.
    $start_limit = ($page_number - 1) * $limit;  

    //search function
    $query = "";    
    if(isset($_GET['query'])) {
        $q=$_GET['query'];
        $query = "WHERE title like '%$q%'";
    }    