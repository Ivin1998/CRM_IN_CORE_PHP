<?php
include '../database/connections.php';
$currentDirectory = getcwd();
$uploadDirectory = '/upload_files/';
session_start();
$user_id = $_SESSION['user_id'];
$errors = [];

$fileExtensionAllowed = ['jpeg', 'jpg', 'pdf', 'docx', 'csv', 'xlsx', 'png','mp4'];

$fileName = $_FILES['the_file']['name'];
$fileSize = $_FILES['the_file']['size'];
$fileType = $_FILES['the_file']['type'];
$fileTmpName = $_FILES['the_file']['tmp_name'];
$fileNameParts = explode('.', $fileName);
$fileExtension = strtolower(end($fileNameParts));

$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

$created_date = $_POST['created_date'];

$flag = 0;


if (!$fileName) {
    $flag = 1;
    echo json_encode(array("result" => $flag, 'msg' => 'No file selected'));
    exit();
}

if (!in_array($fileExtension, $fileExtensionAllowed)) {
    $flag = 1;
    echo json_encode(array("result" => $flag, 'msg' => 'This file extension is not allowed'));
    exit();
}


if ($fileSize > 8000000) {
    $flag = 1;
    echo json_encode(array("result" => $flag, 'msg' => 'File exceeds 4MB! Please try with different image'));
    exit();
}


$didupload = move_uploaded_file($fileTmpName, $uploadPath);

if ($didupload) {
    $sql = "INSERT INTO files (file_name, file_size, file_type,uploaded_date,user_id) VALUES ('$fileName', '$fileSize', '$fileType','$created_date','$user_id')";
    $result = mysqli_query($con, $sql);
    if ($result) {

        echo json_encode(array("result" => $flag, 'msg' => 'File uploaded successfully'));
    } else {
        $flag = 1;
        echo json_encode(array('result' => $flag, 'msg' => 'File upload failed'));

    }
}
?>