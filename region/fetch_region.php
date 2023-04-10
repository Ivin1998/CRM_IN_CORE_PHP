<?php
include '../database/connections.php';

if($_POST['type']==1){
    if (isset($_POST['id'])) {
        $id=$_POST['id'];
         $query="SELECT * FROM countries WHERE id=$id"; 
        $result = mysqli_query($con, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);
    }
}
elseif($_POST['type']==2){

    if (isset($_POST['id'])) {
        $id=$_POST['id'];
         $query="SELECT * FROM states WHERE id=$id"; 
        $result = mysqli_query($con, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);
    } 
}
elseif($_POST['type']==3){

    if (isset($_POST['id'])) {
        $id=$_POST['id'];
         $query="SELECT * FROM cities WHERE id=$id"; 
        $result = mysqli_query($con, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);
    } 
}
  
?>
