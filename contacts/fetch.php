<?php
include '../database/connections.php';
if (isset($_POST['id'])) {
   
    $query= "SELECT * FROM contacts WHERE unique_id= '".$_POST["id"]."'";
    $result = mysqli_query($con, $query);  
    $row = mysqli_fetch_array($result);  
    echo json_encode($row);
}
?>