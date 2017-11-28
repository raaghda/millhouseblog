<? 
    require 'parts/database.php';
    require 'parts/functions.php';

    $month = $_GET["month"];
    $number_of_comments = count_comments($month);

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

<div class="container landingpage">
    <h1 class="light_spacious">
        <? 
        
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

    <div class="row">
        <div class="col-lg-9">

        <div class="dateorder">
            
            <!--Button to choose if you want to DESC or ASC-->

            Sortera efter:

            <? if($dateorder == "ASC"){ ?>

            <a class="dateorder_active" href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=ASC">Äldst först</a>
            <a href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=DESC">Senaste först</a>

            <? } else {?>
            
            <a class="dateorder_active" href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=DESC">Senaste först</a>
            <a href="/millhouseblog/www/?page=displaymonth&month=<?= $month ?>&dateorder=ASC">Äldst först</a>

        <?  }  ?>

        </div>

        <? 
            foreach($months as $monthpost){ 
                $userid = $monthpost["userid"];
                $username = get_column_with_input("username", "user", "userid", $userid);
                $category_id = $monthpost["categoryid"];
                $category_name = get_column_with_input('name', 'category', 'categoryid', $category_id);
                $date = $monthpost["date"];
                $dt = new datetime($date);
                $month_text = make_string_shorter($monthpost["text"], 500);
        ?>

        <article class="post">
            <header>
                <span class="uppercase grey"><?= $category_name ?></span>
                <h2 class=”postheading”><?= $monthpost["title"] ?></h2>
                <time><?= $dt->format('Y-m-d'); ?></time>
                <span class="uppercase grey"><?= $username ?></span>
                <a href="/millhouseblog/www/?page=viewpost&id=<?= $monthpost["postid"]; ?>#comments">
                
                    <!--#comments anchor-->
                    <?= '(' . $number_of_comments . ')'; 

                    if($number_of_comments == 1){
                        echo ' kommentar'; } else{
                        echo ' kommentarer';
                    } ?> 

                </a>
                <p> <?= $month_text; ?> </p>
                <nav class=””>
                    <a href="/millhouseblog/www/?page=viewpost&id=<?= $monthpost["postid"]; ?>">Läs hela inlägget</a>
                </nav> 
            </header>    
        </article>

        <? } 
        
        /* Message if there is no posts in selected month */

        if (empty($monthpost)){
            echo '<div class="post">' . 'Tyvärr finns det inga inlägg för den här månaden...' . '</div>';
        } ?>
    </div><!--/col-lg-9-->
        <div class="col-lg-3 sidebar hidden-xs-down">
            <?php
                require 'components/sidebar.php';
            ?>
        </div>
    </div> <!--row div-->
</div> <!--container-->