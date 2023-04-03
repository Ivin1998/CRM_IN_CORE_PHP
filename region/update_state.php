<?php

include '../database/connections.php';

$state_name=$_POST['name'];
$id=$_POST['id'];

$sql="UPDATE states SET name='$state_name' where id='$id'";
$result = mysqli_query($con,$sql);

?>