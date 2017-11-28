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

<div class="container_feed">
    <div class="wrapper">

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
        <div class="post_wrapper col-lg-9">
             
            <div class="dateorder">
            
            <!--Button to choose if you want to DESC or ASC-->

            Sortera efter:

            <? if($dateorder == "ASC"){ ?>

            <a class="dateorder_active" href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=ASC">Äldst först</a>
             <a href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=DESC">Senaste först</a>

            <? } else {?>
            
             <a class="dateorder_active" href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=DESC">Senaste först</a>
             <a href="/millhouseblog/www/?page=category&categoryid=<?= $categoryid ?>&dateorder=ASC">Äldst först</a>

            <?  }  ?>

            </div>

            <? 
            foreach($posts as $postinfo){ 
                $userid = $postinfo["userid"];
                $username = get_column_with_input("username", "user", "userid", $userid);
                $date = $postinfo["date"]; 
                $dt = new datetime($date);
                $image = $postinfo['image'];
                $title = $postinfo['title'];
                $post_id = $postinfo['postid'];
                
            //if post-text is longer than 120ch, shorten it
    $post_text = make_string_shorter($postinfo['text'], 120);
         
          //if title-text is longer than 30ch, shorten it
    $post_title = make_string_shorter($postinfo['title'], 30);
            ?>

            <article class="feed">
               
               <div class="row">
               
               <div class="thumb_wrap col-md-4">
      <a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>"><img src="/millhouseblog/www/postimages/<?=$image?>" class="img-thumbnail" alt="<?=$title;?>"></a>
      </div>
              
              <div class="post_content col-md-8">
               
                <header>
                    <span class="uppercase grey"><?= $postinfo["category_name"] ?></span>
                    <h2 class=”postheading”><a href="/millhouseblog/www/?page=viewpost&id=<?=$post_id?>"><?=$post_title;?></a></h2>
                    
                     <span class="grey">
            Publicerat 
        <time>
            <?= $dt->format('Y-m-d'); ?>
            </time>
        av
        </span>
                    <span class="uppercase grey"> <?= $username ?></span>
                         
                    <p> <?= $post_text; ?> </p>
                    <nav class=””>
                        <a href="/millhouseblog/www/?page=viewpost&id=<?= $postinfo["postid"]; ?>">Läs hela inlägget</a> |  <a href="/millhouseblog/www/?page=viewpost&id=<?= $postinfo["postid"]; ?>#comments">

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

            <? } 

                if (empty($posts)){
                    echo 
                '<div class="no_post">' . 
                'Tyvärr finns det inga inlägg här...' .
                '</div>';
                }

            ?>

        </div><!--/col-lg-9-->
        <div class="col-lg-3 sidebar hidden-xs-down">
            <?php
                require 'components/sidebar.php';
            ?>
        </div>
    </div> <!--row div-->
    </div>
</div> <!--container-->