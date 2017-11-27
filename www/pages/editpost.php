<?php
require './parts/database.php';
require './parts/functions.php';

$post_id = $_POST["post_id"]; //Post sent from edit button input on viewpost.php

//query pulling posts out by $post_id sent from edit button in viewpost
$statement = $pdo->prepare("SELECT * FROM post WHERE postid = $post_id");
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post){    
    $title = $post['title'];
    $user_id = $post['userid'];
    $post_id = $post['postid'];
    $category_id = $post['categoryid'];
    $image = $post['image'];
    $date_of_post = $post['date'];
    $text = $post['text'];



$statement = $pdo->prepare("SELECT * FROM category");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
     
//If statement checking if user is logged in and if user is author of post
if(isset($_SESSION['loggedIn']) && (int)$_SESSION['user']['userid'] == $user_id){   
?>

<div class="container createpost">
    <h2>Redigera ditt inlägg</h2>
    <form action="../www/parts/updatepost.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="postid" value="<?=$post_id;?>">

        <div class="container form">
            <div class="form-group row">
                <div class="col-sm-12">
                    <input required id="title" type="text" name="title" value="<?=$title;?>" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea required name="text" rows="10" cols="30" placeholder=""><?=$text;?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
                   
                   <!--category dropdown list-->
                    <select required name="categoryid"> 
                         
                          <?php
                            foreach ($categories as $category){
                                
                                //if post-table categoryid is the same as the category-dropdown
                                if ($category_id == $category['categoryid']){
                                    
                            ?>
                        <!--Select the option dropdown that corresponds with the post's original category-->   
                        <option selected value="<?=$category['categoryid'];?>"><?=$category['name'];?></option> 
               
                          <?php
                            }else{
                                ?>
                            <option value="<?=$category['categoryid'];?>"><?=$category['name'];?></option> 
                            <?php   
                            }}
                            ?>
                    </select>
                </div>
            </div>

           
           
           
            <div class="form-group row">
                <div class="col-sm-10">
                    <?php
                        if ($image != ''){
                     ?>                                                            
                    <img src="/millhouseblog/www/postimages/<?=$image?>" class="img-thumbnail">
                       <?php
                         }
                        ?>
                        
                    <input type="file" name="file" accept=".jpg, .jpeg, .png, .gif"><br><br>
                    
                </div>
            </div>
            
            
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" name="submit" value="Publicera">
            </div>
        </div>
    </form>
</div>
<?php
  }else{
    
    //can't use a header here as already echoed out, therefore need to echo not-authorized message
     $_SESSION['notify']['message'] = 'You are not authorized to edit this post.';   
     $_SESSION['notify']['type'] = 'danger';   
    
    //calling function to display message (see parts/notifyfunctions.php)
    display_notification();
    
 }
} 
?>