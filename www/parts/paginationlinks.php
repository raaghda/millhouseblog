<?php     
    //diving the total number of posts in db with the limit of posts per page to get total number of pages.
    //using ceil so if its fex 6.5 its going to be 7 pages
    $total_pages = ceil($number_of_posts_in_db["count"] / $limit);


    /* SETTING THE START_AGE AND END_PAGE FOR LOOPING OUT THE PAGINATION LINKS */
    //if there is only 1 page, set start_page to 1 to make sure it wont loop out -1 or 0
    //set end_page to 1 so it wont loop out more pages than there is
    if($total_pages == 1){
            $start_page = 1;
            $end_page = 1;
        }
        //do the same if there is only 2 pages, but set end_page=2
        elseif ($total_pages == 2)
            {
            $start_page = 1;
            $end_page = 2;
            }
            //if age_number is 1 and there is at least 3 pages, set start_page to 1
            //and end page to 3
            elseif($page_number == 1)
                    {
                    $start_page = 1;
                    $end_page = 3;
                    } 
                    //if youre on the last page, set start_page to -2 and end_page as the total_pages
                    elseif($page_number == $total_pages)
                            {
                            $start_page = $page_number - 2; 
                            $end_page = $total_pages; 
                            }
    //else start_page should be -1 and end_page +1 :)                    
    else
        {
        $start_page = $page_number -1;
        $end_page = $page_number + 1;
        }

// Only shows pagination if there are more than five posts made by the user
if ($number_of_posts_in_db["count"] > 5):
    
    /* LOOPING OUT THE ACTUAL LINKS:) */
    for ($i=$start_page; $i<=$end_page; $i++):
        //if index==page_number set class=active to show that thatss the page user is on
        if($i == $page_number)
            {?>
            <li class="page-item active">
                <a class="page-link" href="/millhouseblog/www/?page=myposts&page_number=<?=$i?>">
                    <?=$i?>
                    <span class="sr-only">
                        (current)
                    </span>
                </a>
            </li>
            <?php
            }   
            //else loop out "regular" page link
            else 
                {?>
                <li class="page-item">
                    <a class="page-link" href="/millhouseblog/www/?page=myposts&page_number=<?=$i?>">
                        <?=$i?>
                    </a>
                </li>
                <?php
                }
    endfor;
    
endif;