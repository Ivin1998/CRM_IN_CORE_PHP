<?php
include '../database/connections.php';
$currentDirectory = getcwd();
$uploadDirectory = '/upload_files/';

$errors = [];

$fileExtensionAllowed = ['jpeg', 'jpg', 'pdf', 'doc', 'csv', 'xlsx', 'png'];

$fileName = $_FILES['the_file']['name'];
$fileSize = $_FILES['the_file']['size'];
$fileType = $_FILES['the_file']['type'];
$fileTmpName = $_FILES['the_file']['tmp_name'];
$fileNameParts = explode('.', $fileName);
$fileExtension = strtolower(end($fileNameParts));

$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

if (isset($_POST['submit'])) {
    if (!in_array($fileExtension, $fileExtensionAllowed)) {
        $errors[] = "This file extension is not allowed";
    }
}


if ($fileSize > 40000000) {
    $errors[] = "File exceeds maximum size (4MB)";
}
if (empty($errors)) {
    $didupload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didupload) {
        echo "The file" . basename($fileName) . "has been uploaded successfully";
    } else {
        echo "An error occurred. Please contact the administrator.";
    }
}


$sql = "INSERT INTO files (file_name, file_size, file_type) VALUES ('$fileName', '$fileSize', '$fileType')";
$result = mysqli_query($con, $sql);

?>