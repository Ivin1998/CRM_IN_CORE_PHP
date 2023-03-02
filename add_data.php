<?php
include 'connections.php';

$created_date=$_POST['created_date'];
$fi_name = $_POST['Fname'];
$la_name = $_POST['Lname'];
$mob_number = $_POST['Mnumber'];
$ofc_numer = $_POST['Onumber'];
$email_id = $_POST['Email'];
$insta_id = $_POST['Instagram'];
$twitter_id = $_POST['Twitter'];
$linked_in = $_POST['Linkedin'];
$fb_id = $_POST['Facebook'];

$sql = "INSERT INTO contact_information(first_name,last_name,mobile_number,office_number,email_id,instagram_id,twitter_id,linkedin_id,facebook_id,created_date) 
values('$fi_name','$la_name','$mob_number','$ofc_numer','$email_id','$insta_id','$twitter_id ','$linked_in','$fb_id','$created_date')";

$success = mysqli_query($con, $sql);

if ($success) {
    echo "User Details added successfully";

} else {
    echo ("Error description: " . '$con -> error');
}
?>