<?php
include '../database/connections.php';


if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "UPDATE contacts SET is_deleted = 1 WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

}
?>