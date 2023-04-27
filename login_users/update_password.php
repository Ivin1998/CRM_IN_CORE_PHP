<?php
include '../database/connections.php';

$user=$_POST['user'];

$password  =$_POST['password'];


$query="UPDATE users SET password ='".md5($password)."' WHERE email='$user'";
$result=mysqli_query($con,$query);

if($result){
    echo "Updated";
}

?>