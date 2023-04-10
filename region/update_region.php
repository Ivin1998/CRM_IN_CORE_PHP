<?php

include '../database/connections.php';


if($_POST['type']==1){
$country_name=$_POST['name'];
$id=$_POST['id'];

$sql="UPDATE countries SET name='$country_name' where id='$id'";
$result = mysqli_query($con,$sql);
if ($result) {
    echo "New country added successfully";

} else {
    echo "Error:" . $sql . "<br>" . $con->error;
}

}
if($_POST['type']==2){
    $state_name=$_POST['name'];
    $id=$_POST['id'];
    
    $sql="UPDATE states SET name='$state_name' where id='$id'";
    $result = mysqli_query($con,$sql);
    if ($result) {
        echo "New state added successfully";
    
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
    
    }

    if($_POST['type']==3){
        $city_name=$_POST['name'];
        $id=$_POST['id'];
        
        $sql="UPDATE cities SET name='$city_name' where id='$id'";
        $result = mysqli_query($con,$sql);

        if ($result) {
            echo "New city added successfully";
        
        } else {
            echo "Error:" . $sql . "<br>" . $con->error;
        }
        
        }

?>