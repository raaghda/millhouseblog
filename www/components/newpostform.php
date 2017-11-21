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
    //if any of the fields not filled, an error message will be returned (see savepost.php for message)
    if (isset($_GET['nocomment'])){?>
    
    <p><?= $_GET['nocomment'];?></p>
    
    <?php
    }
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
                    <textarea required name="text" rows="10" cols="30"></textarea>
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
</div>
