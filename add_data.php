<?php
include 'connections.php';

$user_id = $_POST['user_id'];
$created_date = $_POST['created_date'];
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$mobile_number = $_POST['mobileNumber'];
$office_numer = $_POST['officeNumber'];
$email_id = $_POST['Email'];
$insta_id = $_POST['Instagram'];
$twitter_id = $_POST['Twitter'];
$linked_in = $_POST['Linkedin'];
$fb_id = $_POST['Facebook'];

$sql = "INSERT INTO contact_information(first_name,last_name,mobile_number,office_number,email_id,instagram_id,twitter_id,linkedin_id,facebook_id,created_date,user_id) 
values('$first_name','$last_name','$mobile_number','$office_numer','$email_id','$insta_id','$twitter_id ','$linked_in','$fb_id','$created_date','$user_id')";

$success = mysqli_query($con, $sql);

if ($success) {
    echo "User information updated successfully";

} else {
    echo "Error:" . $sql . "<br>" . $con->error;
}
?>