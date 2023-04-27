<?php
include '../database/connections.php';
$id=$_POST['id'];
if($_POST['type']==1){

$query = "UPDATE users SET is_approved=1 WHERE user_id='$id'";
$result=mysqli_query($con,$query);
if($result)
{
    echo "approved";
}
else{
    echo "Error:" . $$query . "<br>" . $con->error;
}
}
else{
    $query = "UPDATE users SET is_approved=0 WHERE user_id='$id'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        echo "approved";
    }
    else{
        echo "Error:" . $$query . "<br>" . $con->error;
    }
}

?>