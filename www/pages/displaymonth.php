<?php /*cleaned*/
    require 'parts/database.php';
    require 'parts/functions.php';

    $month = $_GET["month"];
    $dateorder = "DESC";

    if(isset($_GET["dateorder"])){
        $dateorder = $_GET["dateorder"];
    }

    /* Selecting given date from database */

    $statement = $pdo->prepare(
        "SELECT * FROM post WHERE MONTH(Date) = :month ORDER by date $dateorder"
    );

    $statement->execute(array(
        ":month" => $month
    ));

    $months = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid feed_container">
    <span class="uppercase"> 
        <h1 class="light_spacious">
            <?php
                /* Headings the selected month via $_GET */
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
            ?>
        </h1>
    </span>
    <div class="row">
        <div class="post_wrapper col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1"> 

            <div class="dateorder">

                <!--Button to choose if you want to DESC or ASC-->

                Sortera efter:

                <?php if($dateorder == "ASC"){ ?>

                <a class="dateorder_active" href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=ASC">
                    Äldst först
                </a>
                <a href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=DESC">
                    Senaste först
                </a>

                <?php } else {?>

                <a class="dateorder_active" href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=DESC">
                    Senaste först
                </a>
                <a href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=ASC">
                    Äldst först
                </a>

                <?php  }  ?>

            </div>

            <?php 
                foreach($months as $monthpost){ 
                    require 'parts/monthpostcontent.php';
                } 

                /* Message if there is no posts in selected month */

                if (empty($monthpost)){
                    echo 
                    '<div class="no_post">' . 
                    'Tyvärr finns det inga inlägg här...' .
                    '</div>';
                } ?>
        </div><!--/col-->
        <div class="col-lg-2 d-none d-md-block sidebar">
            <?php
                require 'components/sidebar.php';
            ?>
        </div>
    </div> <!--row div-->
</div> <!--container-->