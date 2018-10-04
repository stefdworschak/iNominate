<?php
//https://www.w3schools.com/Php/php_file_upload.asp
require('auxilary.php');
require('../init.php');
session_start();

$str = random_str(8);
//echo $str;

$target_dir = "../uploads/profiles/" . $str .'/';
//echo basename($_FILES["upload_photo"]["name"]);
//$target_file = $target_dir . basename($_FILES["upload_photo"]["name"]);
$target_file = $target_dir . $str . '.' . strtolower(pathinfo(basename($_FILES["upload_photo"]["name"]),PATHINFO_EXTENSION));
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
//echo strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//echo $target_dir;

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["upload_photo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["upload_photo"]["size"] > 500000) {
    echo $_FILES["upload_photo"]["size"];
    echo "<br>";
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to create a folder and upload file
} else {
    if (!mkdir($target_dir, 0777, true)) {
        die('Failed to create folders...');
    } else {

      if (move_uploaded_file($_FILES["upload_photo"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["upload_photo"]["name"]). " has been uploaded.";
          $file_link = str_replace('../','core/',$target_file);
          $c = new DBClass;
          $c->imgLink($_SESSION['userid'],$file_link);
          $_SESSION['img_link'] = $file_link;
          header('Location:../../index.php');
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
    }
}
?>
