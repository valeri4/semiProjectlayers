<?php

require_once '../includes/class.upload.php';

session_start();

function createUserPicture($userPicture) {
    $user_picture_name = $_SESSION['uuID'];

    $userPicture = new Upload($_FILES['user_image']);
    if ($userPicture->uploaded) {
        $userPicture->file_new_name_body = $user_picture_name;
        $userPicture->image_resize = true;
        $userPicture->image_x = 300;
        $userPicture->image_ratio_y = true;
        $userPicture->file_overwrite = true;
        $userPicture->image_convert = 'png';
        // save uploaded image with no changes
        $userPicture->Process('../profileImg');
        if ($userPicture->processed) {
            echo 'original image copied';
        } else {
            echo 'error : ' . $foo->error;
        }
    }
}

$command = $_REQUEST['command'];

switch ($command) {

    case "upload":

        if ($_FILES['user_image']['size'] == 0) {
            echo "Size";
            var_dump($_FILES['user_image']);
            break;
        } else
            if (substr($_FILES['user_image']['type'], 0, 5) != "image"){
                echo 'Please select an image like jpg / gif / png / bmp...';
                break;
        }  else {
            if(file_exists("../profileImg") == false){
                mkdir("profileImg");
            }
            
            move_uploaded_file($_FILES["user_image"]["tmp_name"], "../profileImg/".  uniqid().$_FILES['user_image']['name']);
            
            header("Location: ../index.php");
        }

        $uploudedPicture = $_FILES['user_image'];
        createUserPicture($uploudedPicture);

        break;
}