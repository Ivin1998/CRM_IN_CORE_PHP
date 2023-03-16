<?php
date_default_timezone_set('Asia/Calcutta');
include 'connections.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST["submit"])) {

    $fileName = $_FILES["csv_file"]["tmp_name"];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));
    $newFileName = date("Y.m.d") . "-" . date("h.i.s") . "." . $fileExtension;
    $targetDirectory = "uploads/" . $newFileName;
    move_uploaded_file($_FILES["csv_file"]["tmp_name"], $targetDirectory);
    error_reporting(-1);
    $spreadsheet = IOFactory::load($targetDirectory);
    $worksheet = $spreadsheet->getActiveSheet();
    foreach ($worksheet->getRowIterator(2) as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        $first_name = $cellIterator->current()->getValue();
        $cellIterator->next();
        $last_name = $cellIterator->current()->getValue();
        $cellIterator->next();
        $mobile_number = $cellIterator->current()->getValue();
        $cellIterator->next();
        $office_number = $cellIterator->current()->getValue();
        $cellIterator->next();
        $email_id = $cellIterator->current()->getValue();
        $cellIterator->next();
        $instagram_id = $cellIterator->current()->getValue();
        $cellIterator->next();
        $twitter_id = $cellIterator->current()->getValue();
        $cellIterator->next();
        $linkedin_id = $cellIterator->current()->getValue();
        $cellIterator->next();
        $facebook_id = $cellIterator->current()->getValue();
        $cellIterator->next();
        $created_date = date("Y-m-d H:i:s");
        $cellIterator->next();

        $sql = "INSERT INTO contact_information (first_name,last_name,mobile_number,office_number,email_id,instagram_id,twitter_id,linkedin_id,facebook_id,created_date,user_id)
        values('$first_name','$last_name','$mobile_number','$office_number','$email_id','$instagram_id','$twitter_id ','$linkedin_id','$facebook_id','$created_date','$user_id')";
        $success = mysqli_query($con, $sql);
    }

    if ($success) {
        echo "User information updated successfully";

    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
?>