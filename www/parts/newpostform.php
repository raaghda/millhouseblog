<?php
require './parts/database.php';


    $statement = $pdo->prepare(
        "SELECT * FROM category" 
    );

    $statement->execute();

    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="container createpost">
    <h2>Skriv nytt inlägg</h2>
    
    
    <?php
    //if any of the fields not filled, an error message will be returned
    //using display_notification function from parts/notifyfunctions.php
    
    display_notification();
    
    ?>
    
  
    <form action="parts/savepost.php" method="POST" enctype="multipart/form-data">

        <div class="container form">
            <div class="form-group row">
                <div class="col-sm-12">
                   <input required id="title" type="text" name="title" placeholder=" Titel"> 
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <!--Textarea using CK Edit 5 ID-->
                    <textarea name="text" id="editor" rows="10" cols="30"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
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
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
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
 
<!-- JS for CK EDITOR 5 -->       
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</div>
