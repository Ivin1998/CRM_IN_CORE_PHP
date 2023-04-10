<?php
include '../database/connections.php';

if ($_POST['type'] == 1) {
    $country_name = $_POST['name'];
    $sql = "INSERT INTO countries (name)VALUES ('$country_name')";
    $success = mysqli_query($con, $sql);

    if ($success) {
        echo "New country added successfully";

    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
if ($_POST['type'] == 2) {
    $state_name = $_POST['name'];
    $sql = "INSERT INTO states (name)VALUES ('$state_name')";
    $success = mysqli_query($con, $sql);

    if ($success) {
        echo "New state added successfully";

    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
if ($_POST['type'] == 3) {
    $city_name = $_POST['name'];
    $sql = "INSERT INTO cities (name)VALUES ('$city_name')";
    $success = mysqli_query($con, $sql);

    if ($success) {
        echo "New city added successfully";

    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
?>