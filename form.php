<?php
include 'connections.php';

$a=$_POST['Fname'];
$b=$_POST['Lname'];
$c=$_POST['Mnumber'];
$d=$_POST['Onumber'];
$e=$_POST['Email'];
$f=$_POST['Instagram'];
$g=$_POST['Twitter'];
$h=$_POST['Linkedin'];
$i=$_POST['Facebook'];

$sql="INSERT INTO contact_information(first_name, last_name,mobile_number,office_number,email_id,instagram_id,twitter_id,linkedin_id,facebook_id) 
values('$a','$b','$c','$d','$e','$f','$g','$h','$i')";
$success=mysqli_query($con,$sql);
if($success)
{
echo "User Details added successfully";

}
else
{
echo "User Details not added";
} 
?>