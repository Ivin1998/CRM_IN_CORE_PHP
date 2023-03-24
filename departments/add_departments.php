<?php
include '../database/connections.php';

$department_name=$_POST['department_name'];
$sql="INSERT INTO department (department_name) VALUES ('$department_name')";
$success = mysqli_query($con, $sql);

if($success){
    echo "user added";
}
else{
    echo "failed"; 
}
?>