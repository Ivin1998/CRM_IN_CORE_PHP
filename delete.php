<?php
include('connections.php');


if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $sql = "UPDATE contact_information SET is_deleted = 1 WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $sql);

    /* For hard deletion purpose we can use the below */
    // if($result){
    // $sql = "DELETE FROM contact_information WHERE user_id = '$user_id' AND id_deleted = false";
    // $result = mysqli_query($con, $sql);  
    // }

}
?>