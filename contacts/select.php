<?php
include '../database/connections.php';
if (isset($_POST['id'])) {
    $output = '';
    $query = "SELECT * FROM contacts WHERE unique_id= '" . $_POST["id"] . "'";
    $result = mysqli_query($con, $query);
    $output .= '
    <div class="table-responsive">  
    <table class="table table-bordered">';

    while ($row = mysqli_fetch_array($result)) {
        $output .= '
   

   <tr>  
   <td width="30%"><label>First Name</label></td>  
   <td width="70%">' . $row["first_name"] . '</td> 
   <tr><td width="30%"><label>Last Name</label></td> 
   <td width="70%">' . $row["last_name"] . '</td></tr>
   <tr><td width="30%"><label>Mobile Number</label></td> 
   <td width="70%">' . $row["mobile_number"] . '</td></tr>
   <tr><td width="30%"><label>Office Number</label></td> 
   <td width="70%">' . $row["office_number"] . '</td></tr>
   <tr><td width="30%"><label>Email Address</label></td> 
   <td width="70%">' . $row["email_id"] . '</td></tr>
   <tr><td width="30%"><label>Instagram Profile</label></td> 
   <td width="70%">' . $row["instagram_id"] . '</td></tr>
   <tr><td width="30%"><label>Twitter Handle</label></td> 
   <td width="70%">' . $row["twitter_id"] . '</td></tr>
   <tr><td width="30%"><label>LinkedIn Profile</label></td> 
   <td width="70%">' . $row["linkedin_id"] . '</td></tr>
   <tr><td width="30%"><label>Facebook Id</label></td> 
   <td width="70%">' . $row["facebook_id"] . '</td></tr>
    </tr> 
    ';
    }
    $output .= '
    </table>
    </div>
    ';
    echo $output;
}
?>