<?php

    $userid = $monthpost["userid"];
    $username = get_column_with_input("username", "user", "userid", $userid);
    $category_id = $monthpost["categoryid"];
    $category_name = get_column_with_input('name', 'category', 'categoryid', $category_id);
    $date = $monthpost["date"];
    $dt = new datetime($date);
    $image = $monthpost['image'];
                $title = $monthpost['title'];
                $post_id = $monthpost['postid'];

    $number_of_comments = count_comments($post_id);
                
    //if post-text is longer than 120ch, shorten it
    $post_text = make_string_shorter($monthpost['text'], 120);
         
    //if title-text is longer than 30ch, shorten it
    $post_title = make_string_shorter($monthpost['title'], 30);
?>

<article class="single_post_in_feed">
    <div class="row">
        <div class="thumbnail_wrapper col-md-4">
            <div class="thumbnail">
                <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>">
                    <img src="/millhouseblog/www/postimages/<?=$image?>" 
                    class="post_image" alt="<?=$title;?>">
                </a>
            </div>
        </div>
           
        <div class="post_content col-md-8">
           <header>
               <span class="uppercase grey"><?= $category_name ?></span>
                <h2 class=”postheading”>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>"><?=$post_title;?></a>
                </h2>
                <span class="grey"> 
                    Publicerat 
                    <time> <?= $dt->format('Y-m-d'); ?> </time>
                    av
                </span>
                <span class="uppercase grey"><?= $username?></span>
                <p> <?= $post_text; ?> </p>
                <nav class=””>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?= $monthpost["postid"]; ?>">Läs hela inlägget</a> | <a href="/millhouseblog/www/?page=viewpost&id=<?= $monthpost["postid"]; ?>#comments">
                
                    <!--#comments anchor-->
                    <?= '(' . $number_of_comments . ')'; 

                    if($number_of_comments == 1){
                        echo ' kommentar'; } else{
                        echo ' kommentarer';
                    } ?> 

                </a>
                </nav> 
            </header> 
        </div>
    </div>   
</article>