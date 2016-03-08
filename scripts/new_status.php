<?php

//uncomment these to find errors
//also comment out the header to be able to see the errors
// ini_set('display_errors',1);
// error_reporting(E_ALL);


//       upload file to correct directory
//
//
//
$new_status = $_POST['name'];
$target_dir = "../logos/";
$target_file = $target_dir . $new_status;
$uploadOk = 1;
$imageFileType = pathinfo(basename($_FILES["logo"]["name"]),PATHINFO_EXTENSION);
$target_file = $target_file . '.' . $imageFileType;
$target_file = str_replace(' ', '', $target_file);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
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
if ($_FILES["logo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

//resizing image to logo size
// $im = new Imagick($_FILES["logo"]["tmp_name"]);
// $im->resizeImage(40 , 40, imagick::FILTER_LANCZOS, 0.9, true);
// $im->writeImage($_FILES["logo"]["tmp_name"]);

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
        header('Location: ../Input.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//   add information to db about new status
//
//
//
//establishing link to database
$db = new SQLite3('testing.db') or die('Unable to open database');
//determining id of new status, depending on how many status' there already are
$id = $db->querySingle("SELECT COUNT(*) FROM statuses");
$id = $id + 1;
$link_to_new_file = "logos/" . $new_status . '.' . $imageFileType;
$link_to_new_file = str_replace(' ', '', $link_to_new_file);
//this if statement is here in the case that the url to this script is accesssed
//if this script is not accessed correctly (from the form on the input page) it would create a new status with a blank name
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $sql = "INSERT INTO statuses (id, name, link) VALUES ('$id', '$new_status', '$link_to_new_file')";
    $db->exec($sql);
}    

header('Location: ../Input.php');   
?>