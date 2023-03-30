<?php
include '../database/connections.php';

if(isset($_POST['country_id'])){


$country_id=$_POST["country_id"];

$sql="SELECT * FROM states where country_id=$country_id";
$result_state=mysqli_query($con,$sql);
}
while($row=mysqli_fetch_array($result_state))
{?>
    <option value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?></option>
    
    <?php
    }?>


