<?php

//================ CROPPING FILE TO 16:9 ASPECT RATIO =================
                
    // variable set for aspect ratio
    $aspect_ratio = 16/9;

    // IF-statement checking file extention to ensure we use the right 
    // imagecreatefrom function for that file type.
    // Imagecreatefrom...() returns an image identifier,
    // representing the image obtained from the given filename.
    // Assigning image identifier to $img_src.
    if ($fileActualExt == 'jpg' || $fileActualExt == 'jpeg'){
        $img_src = imagecreatefromjpeg('../postimages/'.$fileNameNew);
                    
    }else if ($fileActualExt == 'png'){
        $img_src = imagecreatefrompng('../postimages/'.$fileNameNew);
                    
    }else if ($fileActualExt == 'gif'){
        $img_src = imagecreatefromgif('../postimages/'.$fileNameNew);
    }
                
    //imagesy() function that returns the HEIGHT of the given image resource ($img_src).
    //imagesx() function that returns the WIDTH of the given image resource ($img_src).
    $original_image_height = imagesy($img_src);
    $original_image_width = imagesx($img_src);
                
                
    // min function finds lowest value 
    // compares ORIGINAL_IMAGE_WIDTH divided by ASPECT RATIO 
    // (this calculation will be the height of the new image if original-image-width becomes the NEW width)
    // with original image height and choose the smallest to be $new_height.
    $new_height= min(($original_image_width/$aspect_ratio), $original_image_height);

    // new_width is equal to the new_height multiplied by aspect ratio 
    $new_width = $new_height * $aspect_ratio;
                
    // Finding the difference between the two midpoints
    // in order to position the new image at the midpoint of original image width. 
    // $x is the starting point. 
    $x = ($original_image_width/2) - ($new_width/2);

    // Same midpoint calculation for height.
    $y=($original_image_height/2) - ($new_height/2);
                
        
    // Variable created for the new cropped image.
    // Imagecrop function used to crop an image to the given rectangle,
    // using the information determined above.
    // The cropping rectangle as an array with keys x, y, width and height.
    // resource: imagecrop ( resource: $image , array: $rect )
    $cropped_image = imagecrop($img_src, ['x' => $x, 'y' => $y, 'width' => $new_width, 'height' => $new_height]);
                
    // If the cropped_image succeeds, then use imagejpeg/imagepng/imagegif functions
    // to output the image to browser or file and place it in postimages folder,
    // so that we can link to it and display on viewpost/home
    // (If false, then will just use original image.)
    if ($cropped_image !== FALSE) {
                    
        if ($fileActualExt == 'jpg' || $fileActualExt == 'jpeg'){
            imagejpeg($cropped_image, '../postimages/'.$fileNameNew);
                        
        }else if ($fileActualExt == 'png'){
            imagepng($cropped_image, '../postimages/'.$fileNameNew);
                        
        }else if ($fileActualExt == 'gif'){
            imagegif($cropped_image, '../postimages/'.$fileNameNew);
        }
    }            