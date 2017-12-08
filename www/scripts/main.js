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


/* Comments */

// When the user is typing in the comment field, 
jQuery("#comment_field_viewpost").on('keyup',function(){
    //When the typed text exceeds 0
    if(jQuery(this).val().length > 0) {
        //The text is cropped to max. 150 chars
        jQuery(this).val(jQuery(this).val().substring(0,150));
        //The typed text length is displayed out of 150 chars.
        jQuery("#comment_length").html(jQuery(this).val().length + "/150 tecken.");
    } else {
        //If text is 0, display nothing
         jQuery("#comment_length").html("");
    }
});