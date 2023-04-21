<?php
include '../database/connections.php';
$first_name=$_POST['firstName'];
$last_name=$_POST['lastName'];
$email=$_POST['email'];
$password=$_POST['confirmPassword'];

$sql = "INSERT INTO users(first_name,last_name,email,password) VALUES ('$first_name','$last_name','$email',md5('$password'))";
$success = mysqli_query($con, $sql);
if ($success) {
    echo "User information updated successfully";

} else {
    echo "Error:" . $sql . "<br>" . $con->error;
}
?>
