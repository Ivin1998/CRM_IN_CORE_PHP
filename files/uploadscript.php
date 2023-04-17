<?php
include '../database/connections.php';
$currentDirectory = getcwd();
$uploadDirectory = '/upload_files/';
session_start();
$user_id = $_SESSION['user_id'];
$errors = [];

$fileExtensionAllowed = ['jpeg', 'jpg', 'pdf', 'docx', 'csv', 'xlsx', 'png', 'mp4'];

$results = array(); //creating an empty array

foreach ($_FILES['the_file']['name'] as $key => $fileName) { //$key is the index value for representing all files
    $fileSize = $_FILES['the_file']['size'][$key];
    $fileType = $_FILES['the_file']['type'][$key];   //key used to store the values of each files separately, here the value of key is filename 
    $fileTmpName = $_FILES['the_file']['tmp_name'][$key];
    $fileNameParts = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameParts));
   
    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

    $created_date = $_POST['created_date'];

    $flag = 0;

    if (!$fileName) {
        $flag = 1;
        $results[$key] = array("result" => $flag, 'msg' => 'No file selected');
        continue; //continue is used to jump to next file when the condition fails
    }

    if (!in_array($fileExtension, $fileExtensionAllowed)) {
        $flag = 1;
        $results[$key] = array("result" => $flag, 'msg' => 'This file extension is not allowed');
        continue; //allowing the code to check the conditions for the remaining files
    }


    if ($fileSize > 8000000) {
        $flag = 1;
        $results[$key] = array("result" => $flag, 'msg' => 'File exceeds 4MB! Please try with different image');
        continue;
    }


    $didupload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didupload) {
        $sql = "INSERT INTO files (file_name, file_size, file_type,uploaded_date,user_id) VALUES ('$fileName', '$fileSize', '$fileType','$created_date','$user_id')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $results[$key] = array("result" => $flag, 'msg' => 'File uploaded successfully');

        } else {
            $flag = 1;
            $results[$key] = array('result' => $flag, 'msg' => 'File upload failed');

        }
    }   
}
;

echo json_encode($results);

?>