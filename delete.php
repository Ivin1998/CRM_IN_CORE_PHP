<?php
include('connections.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];



    $sql = "DELETE FROM contact_information WHERE user_id='$user_id'";

    $result = mysqli_query($con, $sql);

    if ($result == TRUE) {
        echo "Record deleted successfully";
    } else {
        echo " Error:" . $sql . "<br>" . $con->error;
    }

}
?>