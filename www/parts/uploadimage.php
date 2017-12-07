<?php

// UPLOAD_ERR_OK -> Value: 0; There is no error, the file uploaded with success
//http://php.net/manual/en/features.file-upload.errors.php.

//if form has been submitted && there is a file  
   if(isset($_POST['submit']) && $_FILES['file']['error'] == UPLOAD_ERR_OK){

        //CREATE VARIABLES TO CHECK FILE INFORMATION

        //created variable equal to superglobal $_FILES and the name of the file ['file']
        $file = $_FILES['file'];

        //print_r($file);

        //variable equal to superglobal $_FILES [name of 'file'][info we want to extract - 'name']   
        $fileName = $_FILES['file']['name'];

        //variable for temporary location of the file   
        $fileTmpName = $_FILES['file']['tmp_name'];

        //variable for size of the file   
        $fileSize = $_FILES['file']['size'];

        //variable for error    
        $fileError = $_FILES['file']['error'];

        //variable for file type  
        $fileType = $_FILES['file']['type'];


        //variable explode used to separate the name of the file and the extension  
        $fileExt = explode('.', $fileName);

        //strtolower case function makes the extention lowercase
        //end function gets the last piece of info, in this case extension
        $fileActualExt = strtolower(end($fileExt));

        //array created to hold file-types that are allowed to be uploaded    
        $allowed = array('jpg','jpeg','png','gif');

        //boolean in_array checks the file extention ($file_ActualExt) against the types listed in the array   
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if($fileSize < 5000000){

                    //start uploading the file
                    //variable created for new file name in order to avoid overwriting (unique id function using time stamp and file ext)
                    $fileNameNew = uniqid('',true).".".$fileActualExt;

                    //variable created to place file in location 
                    $fileDestination = '../postimages/'.$fileNameNew;

                    //function movest the file from old temp location  to new location ($fileDestination)
                    move_uploaded_file($fileTmpName,$fileDestination);
                    
                    // Once file has been moved to folder,
                    // can begin to crop image to 16:9 ratio.
                    require 'cropimage.php';


                }else{
                   notify('warning', 'Din fil är för stor.');
                   // Redirects to target page (either viewpost or createpost page)
                   // See parts/updatepost.php and parts/savepost.php.    
                   header("Location: /millhouseblog/www/?page=".$target_page);
                   exit();    
                    
                }
            }else{
                notify('warning', 'Det uppstod ett fel vid uppladdning av den här filen.');
                header("Location: /millhouseblog/www/?page=".$target_page);
                exit(); 
            }
        
        }else{
            notify('warning', 'Du kan inte ladda upp filer av denna typ.');
            header("Location: /millhouseblog/www/?page=".$target_page);
            exit();
        }   
   } 

else {
       //else $fileNameNew is empty
       $fileNameNew = null;
}