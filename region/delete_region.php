<?php
include '../database/connections.php';
if($_POST['type']==1){
    if(isset($_POST['id'])){
        $id=$_POST['id'];
          $sql="UPDATE countries SET is_deleted = 1 WHERE id = $id";
          $result = mysqli_query($con, $sql);

}}
elseif($_POST['type']==2){
    if(isset($_POST['id'])){
      $id=$_POST['id'];
        $sql="UPDATE states SET is_deleted = 1 WHERE id = $id";
        $result = mysqli_query($con, $sql);
    
    }

}elseif($_POST['type']==3){
    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $sql="UPDATE cities SET is_deleted = 1 WHERE id = $id";
        $result = mysqli_query($con, $sql);

    }
  
}
?>