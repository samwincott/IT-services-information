<?php

//       upload file to correct directory
$new_status = $_POST['new_status_name'];
$target_dir = "../logos/";
$target_file = $target_dir . $new_status;
$uploadOk = 1;
$imageFileType = pathinfo(basename($_FILES["new_status_logo"]["name"]),PATHINFO_EXTENSION);
$target_file = $target_file . '.' . $imageFileType;
$target_file = str_replace(' ', '', $target_file);
// Check if image file is a actual image or fake
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["new_status_logo"]["tmp_name"]);
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
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["new_status_logo"]["tmp_name"], $target_file)) {
<<<<<<< HEAD
=======
        echo "The file ". basename( $_FILES["new_status_logo"]["name"]). " has been uploaded.";
>>>>>>> 366e1540c9674b658b166f2f2dab7590ca57dfea
        header('Location: ../Input.php');
    } 
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//   add information to db about new status
//establishing link to database
$db = new SQLite3('info.db') or die('Unable to open database');
//determining id of new status, depending on how many statuses there already are
$id = $db->querySingle("SELECT COUNT(*) FROM statuses");
$id = $id + 1;
$link_to_new_file = "logos/" . $new_status . '.' . $imageFileType;
$link_to_new_file = str_replace(' ', '', $link_to_new_file);
<<<<<<< HEAD
if (isset($_POST['new_status_name']) && !empty($_POST['new_status_name']) && uploadOk != 0) {
    $sql = "INSERT INTO statuses (id, name, link) VALUES ('$id', '$new_status', '$link_to_new_file')";
    $db->exec($sql);
}       
=======
if (isset($_POST['new_status_name']) && !empty($_POST['new_status_name'])) {
    $sql = "INSERT INTO statuses (id, name, link) VALUES ('$id', '$new_status', '$link_to_new_file')";
    $db->exec($sql);
}    

header('Location: ../Input.php');   
>>>>>>> 366e1540c9674b658b166f2f2dab7590ca57dfea
?>