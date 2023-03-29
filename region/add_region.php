<?php
include '../database/connections.php';
$city_name = $_POST['city'];
$value = $_POST['flag'];

$sql = "INSERT INTO region (region,flag_value) VALUES ('$city_name','$value')";
$success = mysqli_query($con, $sql);

/* if ($success) {
    echo "user added";
} else {
    echo "failed";
} */

?>