<?php
 date_default_timezone_set('Asia/Calcutta');

 include '../database/connections.php';

    $department_name=$_POST['department_name'];
    $mod_date=$_POST['mod_date'];
    $id = $_POST['id'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $mobile_number = $_POST['mobileNumber'];
    $office_number = $_POST['officeNumber'];
    $email_id = $_POST['Email'];
    $instagram_id = $_POST['Instagram'];
    $twitter_id = $_POST['Twitter'];
    $linkedin_id = $_POST['Linkedin'];
    $facebook_id = $_POST['Facebook'];
    $country=$_POST['country'];
    $state=$_POST['state'];
    $city=$_POST['city'];

    $sql = "UPDATE contacts SET first_name='$first_name',last_name='$last_name',mobile_number='$mobile_number',office_number='$office_number',email_id='$email_id',instagram_id=' $instagram_id',
    twitter_id='$twitter_id',linkedin_id='$linkedin_id',facebook_id='$facebook_id',mod_date='$mod_date',department_id=' $department_name',country_id='$country',state='$state',city='$city' where id='$id'";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo "Record updated Successfully";
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
?>