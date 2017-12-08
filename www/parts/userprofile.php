<!-- User profile with image and statistics -->
<div class="row">
        <div class="col-10 offset-1">
            <img title="Klicka för att ändra din avatar" src="profilephotos/<?php echo $fetched_user['profilephoto']; ?>" id=profile_avatar 
            alt="Avatar för användare" class="rounded-circle" width="120px" height="120px">
            <h1 id=user_name> <?php echo $fetched_user['name']; ?> </h1>
        </div>
    </div>
    
    <form id="profilephotopicker" action="/millhouseblog/www/parts/uploadprofilephoto.php" method="POST" enctype="multipart/form-data">
             <input type="file" id="file" name="profilePhoto" aria-label="Profilbild" accept=".jpg, .jpeg, .png, .gif"><br><br>
            <input type="submit" id="submitphoto" value="Change!" name="submitPhoto">
    </form>  
          
<div class="row">
    <div class="col-10 offset-1 d-none d-md-block"> 
        <p id=user_stats> <?= $posts_by_user['total'] ?> inlägg på bloggen | 
        <?php if($comments_on_users_posts['total'] == 1)
                {
                    //Fixes grammar for singular/plural posts
                    echo $comments_on_users_posts['total'] . ' mottagen kommentar'; 
                } 
                else
                {
                    echo $comments_on_users_posts['total'] . ' mottagna kommentarer';
                } ?>
        | Medlem sedan <time> <?= $dt->format('Y-m-d'); ?> </time></p>
    </div>
</div> 
    
<!-- Create post-button -->
<div class="row">
    <div class="mx-auto">
        <a class="btn" href="/millhouseblog/www/?page=createpost">Skriv nytt inlägg
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    </div>
</div>