/* Profile */

//If the avatar is clicked
jQuery("#profile_avatar").click(function () {
    //Then the file picker will open
    jQuery('#file').trigger('click');
});
//If a file is picked
jQuery('#file').change(function (evt) {
    //Then the submit-photo button will be clicked
    jQuery('#submitphoto').trigger('click');
});

jQuery("#comment_field_viewpost").on('keyup',function(){
    if(jQuery(this).val().length > 0) {
        jQuery("#comment_length").html(jQuery(this).val().length + "/150 tecken.");
    } else {
         jQuery("#comment_length").html("");
    }
});