<?php
include '../database/connections.php';

$state_id=$_POST['state_id'];

$sql="SELECT * FROM cities WHERE state_id=$state_id";
$result_city=mysqli_query($con,$sql);

while ($row=mysqli_fetch_array($result_city)){
    ?>
<option value="<?php echo $row['id']?>"><?php echo $row['name'] ?></option>

<?php
}?>