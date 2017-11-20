<? require 'parts/database.php'; 
   require 'parts/functions.php';

$categoryid = ($_GET["categoryid"]);
$number_of_comments = count_comments($categoryid);


$dateorder = "DESC";

    if(isset($_GET["dateorder"])){
        $dateorder = $_GET["dateorder"];
    }

    $statement = $pdo->prepare(
        "SELECT userid, title, date, text, postid, category.name as category_name FROM post INNER JOIN category ON post.categoryid = category.categoryid WHERE post.categoryid = :categoryid ORDER by date $dateorder" 
    );

    $statement->execute(array(
        ":categoryid" => $categoryid
    ));

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    

?>

<div class="container landingpage">
<div class="row">
    <div class="col-lg-8">
    
    <h1 class="category_heading"> <?= $posts[0]["category_name"] ?> </h1>
    
<div class="dateorder">
    
    Sortera kategorin efter:
    
   <? if($dateorder == "ASC"){ ?>
    
    <a class="dateorder_active" href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=ASC">Stigande</a>
    <a href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=DESC">Fallande</a>

   <? } else {?>
   
   <a href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=ASC">Stigande</a>
    <a class="dateorder_active" href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=DESC">Fallande</a>
   
   <? } ?>
    
    

</div>

<? foreach($posts as $postinfo){ 
        $userid = $postinfo["userid"];
        $username = get_row_with_input("username", "user", "userid", $userid);
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
            <?= $postinfo["date"] ?>
        </time>
        
        <span class="uppercase grey"> <?= $username ?></span>
        
        <a href="/millhouseblog/www/?page=viewpost&id=<?= $postinfo["postid"]; ?>#comments"><!--#comments anchor-->
        
        <?= '(' . $number_of_comments . ')'; 
        
        if($number_of_comments == 1){
            echo ' kommentar'; } else{
            echo ' kommentarer';
        } ?> 
        </a>
       
       <p> <?= $postinfo["text"] ?> </p>
       <nav class=””>
            <a href="/millhouseblog/www/?page=viewpost&id=<?= $postinfo["postid"]; ?>">Läs hela inlägget</a>
        </nav> 
        
        
        
    </header>
    
</article>


<? } 


if (empty($posts)){
    echo 'There are no posts in this category.';
}
        
?>
        
</div><!--/col-md-8-->

<div class="col-lg-4 sidebar hidden-xs-down">
        <?php
        require 'components/sidebar.php';
        ?>
    </div><!--/sidebar-->
    
</div><!--/col-md-8-->