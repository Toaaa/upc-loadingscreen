<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    $dirname = "../../logo";
    if ( !file_exists($dirname) ) {
        mkdir ($dirname, 0777);
    }
    $ext = array("jpg", "png", "jpeg", "gif");
    $files = array();
    if($handle = opendir($dirname)) {
        while(false !== ($file = readdir($handle)))
            for($i=0;$i<sizeof($ext);$i++)
            if(strstr($file, ".".$ext[$i]))
                $files[] = $file;
                closedir($handle);
    }
    $amount = count($files);
    $i = 0;
    foreach ($files as $img){
        $logo = $img;
        $i++;
    }
    $img = "../../logo/" . $logo;
    if(unlink($img,0777)) {
        $target_dir = "../../logo/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $messages = 0;
        $answer = '';
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
        $uploadOk = 1;
        } else {
        $answer = $answer . ',"message' . $messages . '":"File is not an image"';
        $messages++;
        $status = 'error';
        $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        $answer = $answer . ',"message' . $messages . '":"File already exist."';
        $status = 'error';
        $messages++;
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 10000000) {
        $answer = $answer . ',"message' . $messages . '":"File is too large."';
        $status = 'error';
        $messages++;
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $answer = $answer . ',"message' . $messages . '":"Only JPG, JPEG, PNG & GIF files are allowed."';
        $status = 'error';
        $messages++;
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $answer = $answer . ',"message' . $messages . '":"File ' . htmlspecialchars( basename( $_FILES["file"]["name"])) . ' has been uploaded."';
                $messages++;
                $status = 'succes';
            } else {
                $answer = $answer . ',"message' . $messages . '":"Error ocured."';
                $messages++;
                $status = 'error';
            }
        }
        echo '{"status":"' . $status . '"' . $answer . ' ,"messages":"' . $messages . '","name":"' . basename($_FILES["file"]["name"]) . '"}';
    }else {
        echo '{"status":"error","message":"Error"}';
    }
}else {
    echo '{"status":"error","message":"No permission"}';
}
?>