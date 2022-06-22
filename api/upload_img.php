<?php
$target_dir = "img/";#../../img/
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
?>