<?php
    require 'parts/logincheck.php';
    require 'parts/database.php';

    /* Fetches the categories*/

    $statement = $pdo->prepare(
        "SELECT * FROM category" 
    );

    $statement->execute();

    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);


    //if any of the fields not filled, an error message will be returned
    //using display_notification function from parts/notifyfunctions.php

    display_notification();
        
?>

<main class="createpost_page">
    <div class="container createpost">
        <span class="uppercase">  
            <h1 class="light_spacious">Skriv nytt inlägg</h1>
        </span>

        

        <form action="parts/savepost.php" method="POST" enctype="multipart/form-data">
            <div class="container form">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" required id="title"  name="title" placeholder=" Titel"> 
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <!--Textarea using CK Edit 5 ID-->
                        <textarea name="text" id="editor" rows="10" cols="30"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <select required name="categoryid"> 
                            <option value="" >
                                Välja Kategori
                            </option>       
                            
                            <?php foreach ($categories as $category): ?>                   
                            <option value="<?=$category['categoryid'];?>">
                                <?=$category['name'];?>
                            </option>   
                            <?php endforeach; ?>
                        </select>                    
                    </div>
                    <div class="offset-sm-3 col-sm-5">
                        <input type="file" id="file" class="inputfile" name="file" accept=".jpg, .jpeg, .png, .gif">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input id="publish_button" type="submit" name="submit" value="Publicera">
                    </div>
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
</main>