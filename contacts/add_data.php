<?php
include '../database/connections.php';
$department_name=$_POST['department_name'];
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
$country=$_POST['country'];
$state=$_POST['state'];
$city=$_POST['city'];

$sql = "INSERT INTO contacts(first_name,last_name,department_id,mobile_number,office_number,email_id,instagram_id,twitter_id,linkedin_id,facebook_id,created_date,user_id,country_id,state,city) 
values('$first_name','$last_name','$department_name','$mobile_number','$office_numer','$email_id','$insta_id','$twitter_id ','$linked_in','$fb_id','$created_date','$user_id','$country','$state','$city')";

$success = mysqli_query($con, $sql);

if ($success) {
    echo "User information updated successfully";

} else {
    echo "Error:" . $sql . "<br>" . $con->error;
}
?>