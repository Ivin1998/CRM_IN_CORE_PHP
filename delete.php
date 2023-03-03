<?php
include('connections.php');


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "UPDATE contact_information SET id_deleted = true WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $sql);

    /* For hard deletion purpose we can use the below */
    // if($result){
    // $sql = "DELETE FROM contact_information WHERE user_id = '$user_id' AND id_deleted = false";
    // $result = mysqli_query($con, $sql);  
    // }

    if ($result) {
        echo "Record deleted successfully";
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
?>