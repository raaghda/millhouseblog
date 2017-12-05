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

<main class="editpost_page">
<div class="container editpost">
   <span class="uppercase"> 
    <h1 class="light_spacious">Redigera inlägg</h1>
    </span>
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
                   <!--Textarea using CK Edit 5 ID-->
                   <textarea name="text" id="editor" rows="10" cols="30"><?=$text;?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4">
                    <select required name="categoryid"> 
                        <option value="" >Välja Kategori</option>  
      
                          <?php
                            foreach ($categories as $category){
                            ?>
                   
                        <option value="<?=$category['categoryid'];?>"><?=$category['name'];?></option> 
               
                          <?php
                            }
                            ?>
                    </select>
                    
                </div>
                <div class="offset-sm-3 col-sm-5">
                    <input type="file" id="file" class="inputfile" name="file" accept=".jpg, .jpeg, .png, .gif">
                </div>
            </div>

           
           
           
            <div class="form-group row">
                <div class="col-sm-12 prev_img">
                    <?php
                        if ($image != ''){
                     ?>                                                            
                    <img src="/millhouseblog/www/postimages/<?=$image?>" class="img-thumbnail">
                       <?php
                         }
                        ?>
                        
                    
                </div>
            </div>
            
            <div class="form-group row">
            <div class="col-sm-12">
                <input id="publish_button" type="submit" name="submit" value="Publicera">
            </div>
        </div>
            
            
        </div>
    </form>
    
    
</div>
</main>
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

<!-- JS for CK EDITOR 5 --> 
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>