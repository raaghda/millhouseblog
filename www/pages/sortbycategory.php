<?php
    require 'parts/database.php'; 
    require 'parts/functions.php';

    $categoryid = ($_GET["categoryid"]);
    $number_of_comments = count_comments($categoryid);
    
    // Default dateorder is set to desceding
    $dateorder = "DESC";

    if(isset($_GET["dateorder"])){
        $dateorder = $_GET["dateorder"];
    }

    /* Selecting the choosen category */

    $statement = $pdo->prepare(
        "SELECT userid, title, date, text, image, postid, category.name as category_name FROM post INNER JOIN category ON post.categoryid = category.categoryid WHERE post.categoryid = :categoryid ORDER by date $dateorder" 
    );

    $statement->execute(array(
        ":categoryid" => $categoryid
    ));

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid feed_container"> 
    <span class="uppercase">
        <h1 class="light_spacious"> 
            <?php
                /* Displays title */
                if($_GET["categoryid"] == 01){
                    echo 'Solglasögon';
                } else if($_GET["categoryid"] == 2){
                    echo 'Klockor';
                } else if($_GET["categoryid"] == 3){
                    echo 'Inredning';
                } else if($_GET["categoryid"] == 4){
                    echo 'Lifestyle';
                }
            ?>
        </h1>
    </span>

    <div class="row">
        <div class="post_wrapper col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1">

            <div class="dateorder">

                <!--Button to choose if you want to DESC or ASC-->

                Sortera efter:

                <?php if($dateorder == "ASC"){ ?>

                    <a class="dateorder_active" href="/millhouseblog/www/?page=sortbycategory&categoryid=<?= $categoryid ?>&dateorder=ASC">
                        Äldst först
                    </a>
                    <a href="/millhouseblog/www/?page=sortbycategory&categoryid=<?= $categoryid ?>&dateorder=DESC">
                        Senaste först
                    </a>

                <?php } else {?>

                    <a class="dateorder_active" href="/millhouseblog/www/?page=sortbycategory&categoryid=<?= $categoryid ?>&dateorder=DESC">
                        Senaste först
                    </a>
                    <a href="/millhouseblog/www/?page=sortbycategory&categoryid=<?= $categoryid ?>&dateorder=ASC">
                        Äldst först
                    </a>

                <?php  }  ?>

            </div>

            <?php 
            
                /* Loops all content for posts */
            
                foreach($posts as $postinfo){ 
    
                    require 'parts/categorypostcontent.php';

            } 

            if (empty($posts)){
                echo 
                '<div class="no_post">' . 
                'Tyvärr finns det inga inlägg här...' .
                '</div>';
            }

            ?>
        </div><!--/col-->
        <div class="col-lg-2 d-none d-md-block sidebar_container">
            <?php
                require 'components/sidebar.php';
            ?>
        </div>
    </div> <!--row div-->
</div> <!--container-->