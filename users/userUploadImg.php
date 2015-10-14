<?php

$command = $_REQUEST['command'];

switch ($command) {

    case "upload":

        if ($_FILES['user_image']['size'] == 0) {
            header('location: index.php?error=Please select an image');
        } else
            if (substr($_FILES['user_image']['type'], 0, 5) != "image"){
                header('location: index.php?error=Please select an image like jpg / gif / png / bmp...');
        }  else {
            if(file_exists("Pictures") == false){
                mkdir("Pictures");
            }
            
            move_uploaded_file($_FILES["user_image"]["tmp_name"], "profileImg/".  uniqid().$_FILES['user_image']['name']);
            
            header("Location: ThankYou.php");
        }
        
        break;
}
