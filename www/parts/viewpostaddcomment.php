<!--ADD A COMMENT-->
       <div class="row">
            <div class="col-lg-12">
                <span class="uppercase">
                    <h1 class="light_spacious" id="addcomments_h1">Lägg till en kommentar</h1>
                </span>
             
                <?php       
                    if(isset($_GET['nocomment'])){
                        echo $_GET['nocomment'];
                    }
                ?>
                <div class="row" >
                   <div class="col-lg-12" >
                        <form action="parts/addcomment.php" method="post" id="add_comments_form_viewpost">

                        <? if(!isset($_SESSION['loggedIn'])){ ?>

                            <input type="text" name="name" placeholder="Namn" id="not_logged_in_user">
                            <input type="text" name="email" placeholder="Email" id="not_logged_in_user">

                        <?  } else {} ?>

                            <input type="hidden" name="id" value="<?= $post_id ?>">
                            <input type="text" name="comment" placeholder="Din kommentar:" id="comment_field_viewpost">
                            <input type="submit" name="addcomment" value="Skicka">
                        </form>
                    </div><!--END OF col-lg-12-->
                </div><!--END OF ROW-->
           </div><!--END OF col-lg-12-->
        </div><!--END OF ADD COMMENTS - END OF ROW-->