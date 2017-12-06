<?php
if(isset($_POST['submitPhoto']) && $_FILES['profilePhoto']['error'] == UPLOAD_ERR_OK){
       
    //created variable equal to superglobal $_FILES and the name of the file ['file']
    $file = $_FILES['profilePhoto'];
    
    //print_r($file);
    
    //variable equal to superglobal $_FILES [name of 'file'][info we want to extract - 'name']   
    $fileName = $file['name'];
       
    //variable for temporary location of the file   
    $fileTmpName = $file['tmp_name'];
       
    //variable for size of the file   
    $fileSize = $file['size'];
       
    //variable for error    
    $fileError = $file['error'];
    
    //variable for file type  
    $fileType = $file['type'];
    
  
    //variable explode used to separate the name of the file and the extension  
    $fileExt = explode('.', $fileName);
    
    //strtolower case function makes the extention lowercase
    //end function gets the last piece of the array, in this case extension
    $fileActualExt = strtolower(end($fileExt));
    
    //array created to hold file-types that are allowed to be uploaded    
    $allowed = array('jpg','jpeg','png','gif');
    
    //boolean in_array checks the file extention ($file_ActualExt) against the types listed in the array   
    if (in_array($fileActualExt, $allowed)){
        if($fileSize < 5000000){
            //start uploading the file
            //variable created for new file name in order to avoid overwriting (unique id function using time stamp and file ext)
            $fileNameNew = uniqid('',true).".".$fileActualExt;

            //variable created to place file in location 
            $fileDestination = '../profilephotos/'.$fileNameNew;
    
            //function moves the file from old temp location  to new location ($fileDestination)
            if (move_uploaded_file($fileTmpName,$fileDestination)){
                header("Location: /millhouseblog/www/?page=profile");      
            }
            else{
                echo "Could not upload the file.";
            }

        }else{
           echo "Your file is too big. Max. allowed size is 5MB"; 
        }

    }else{
        echo "You cannot upload files of this type.";
    }
}else {
    header("Location: /millhouseblog/www/?page=profile");    
}

?>