<?php

include '../database/connections.php';

$city_name=$_POST['name'];
$id=$_POST['id'];

$sql="UPDATE cities SET name='$city_name' where id='$id'";
$result = mysqli_query($con,$sql);

?>