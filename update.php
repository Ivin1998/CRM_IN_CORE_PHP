<?php
 date_default_timezone_set('Asia/Calcutta');

include 'connections.php';

    $mod_date=$_POST['mod_date'];
    $user_id = $_POST['user_id'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $mobile_number = $_POST['mobileNumber'];
    $office_number = $_POST['officeNumber'];
    $email_id = $_POST['Email'];
    $instagram_id = $_POST['Instagram'];
    $twitter_id = $_POST['Twitter'];
    $linkedin_id = $_POST['Linkedin'];
    $facebook_id = $_POST['Facebook'];

    $sql = "UPDATE contact_information SET first_name='$first_name',last_name='$last_name',
    mobile_number='$mobile_number',office_number='$office_number',email_id='$email_id',instagram_id=' $instagram_id',
    twitter_id='$twitter_id',linkedin_id='$linkedin_id',facebook_id='$facebook_id',mod_date='$mod_date' where user_id='$user_id'";

    $result = $con->query($sql);


    if ($result == TRUE) {
        echo "Record updated Successfully";
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
?>