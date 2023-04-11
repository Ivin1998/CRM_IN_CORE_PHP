<?php
include '../database/connections.php';
$currentDirectory = getcwd();
$uploadDirectory = '/upload_files/';
session_start();
$user_id = $_SESSION['user_id'];
$fileExtensionAllowed = ['pdf'];

$fileName = $_FILES['the_file']['name'];
$fileSize = $_FILES['the_file']['size'];
$fileType = $_FILES['the_file']['type'];
$fileTmpName = $_FILES['the_file']['tmp_name'];
$fileNameParts = explode('.', $fileName);
$fileExtension = strtolower(end($fileNameParts));

$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

$created_date=$_POST['created_date'];

$isValidFile=1;

if (isset($_POST['submit'])) {

    if (!in_array($fileExtension, $fileExtensionAllowed)) {
        echo "file format not supported";
        $isValidFile = 0;

    }
if ($fileSize > 40000000) {
    echo "File format exceeds the limit";
    $isValidFile = 0;

}
if ($isValidFile==1) {
    $didupload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didupload) {
        echo "The file" . basename($fileName) . "has been uploaded successfully";
    } else {
         echo "Error: " . mysqli_error($con);

    }
}
}
$sql = "INSERT INTO files (file_name, file_size, file_type,uploaded_date,user_id) VALUES ('$fileName', '$fileSize', '$fileType','$created_date','$user_id')";
$result = mysqli_query($con, $sql);

if ($result) {
    echo "File details added to database";
} else {
    echo "Error".mysqli_error($con);
}
   
?>