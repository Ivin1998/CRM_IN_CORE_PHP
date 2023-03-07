<?php
include "connections.php";
if (isset($_POST['user_id'])) {
   
    $query= "SELECT * FROM contact_information WHERE user_id= '".$_POST["user_id"]."'";
    $result = mysqli_query($connect, $query);  
    $row = mysqli_fetch_array($result);  
    echo json_encode($row);
}
?>