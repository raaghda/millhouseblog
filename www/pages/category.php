<? 
    require 'parts/database.php'; 
    require 'parts/functions.php';

    $categoryid = ($_GET["categoryid"]);
    $number_of_comments = count_comments($categoryid);

    $dateorder = "DESC";

    if(isset($_GET["dateorder"])){
        $dateorder = $_GET["dateorder"];
    }

    /* Selecting the choosen category */

    $statement = $pdo->prepare(
        "SELECT userid, title, date, text, postid, category.name as category_name FROM post INNER JOIN category ON post.categoryid = category.categoryid WHERE post.categoryid = :categoryid ORDER by date $dateorder" 
    );

    $statement->execute(array(
        ":categoryid" => $categoryid
    ));

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    

?>

<div class="container landingpage">

<h1 class="light_spacious"> 
<?
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

<div class="row">
    <div class="col-lg-9">
    
<div class="dateorder">
    
    Sortera efter:
    
   <? if($dateorder == "ASC"){ ?>
    
    <a class="dateorder_active" href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=ASC">Äldst först</a>
    <a href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=DESC">Senaste först</a>

   <? } else {?>
   
   
    <a class="dateorder_active" href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=DESC">Senaste först</a>
   <a href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=ASC">Äldst först</a>
   
   <? } ?>
    
    

</div>

<? foreach($posts as $postinfo){ 
        $userid = $postinfo["userid"];
        $username = get_row_with_input("username", "user", "userid", $userid);
        $date = $postinfo["date"]; 
        $dt = new datetime($date);
        $post_text = make_string_shorter($postinfo["text"], 500);
        ?>

<article class="post">
    
    <header>
        
        <span class="uppercase grey">
            <?= $postinfo["category_name"] ?>
        </span>
        <h2 class=”postheading”> 
            <?= $postinfo["title"] ?>
        </h2>
        <time>
            <?= $dt->format('Y-m-d'); ?>
        </time>
        
        <span class="uppercase grey"> <?= $username ?></span>
        
        <a href="/millhouseblog/www/?page=viewpost&id=<?= $postinfo["postid"]; ?>#comments"><!--#comments anchor-->
        
        <?= '(' . $number_of_comments . ')'; 
        
        if($number_of_comments == 1){
            echo ' kommentar'; } else{
            echo ' kommentarer';
        } ?> 
        </a>
       
       <p> <?= $post_text; ?> </p>
       <nav class=””>
            <a href="/millhouseblog/www/?page=viewpost&id=<?= $postinfo["postid"]; ?>">Läs hela inlägget</a>
        </nav> 
        
        
        
    </header>
    
</article>


<? } 


if (empty($posts)){
    echo '<div class="post">' . 'Ingen har postat något i den här kategorin än...' . '</div>';
}
        
?>
        
</div><!--/col-md-8-->

<div class="col-lg-3 sidebar hidden-xs-down">
        <?php
        require 'components/sidebar.php';
        ?>
    </div><!--/sidebar-->
    
</div><!--/col-md-8-->