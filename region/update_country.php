<?php

include '../database/connections.php';

$country_name=$_POST['name'];
$id=$_POST['id'];

$sql="UPDATE countries SET name='$country_name' where id='$id'";
$result = mysqli_query($con,$sql);



?>