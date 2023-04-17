<?php
include '../database/connections.php';
session_start();
$user_id = $_SESSION['user_id'];

$query=$con->query ("SELECT * FROM contacts WHERE is_deleted=0  AND user_id='$user_id'  ORDER BY unique_id DESC ");

if($query->num_rows>0)
{
    $delimiter = ","; 
    $filename = "members-data_" . date('Y-m-d') . ".csv"; 

    $f = fopen('php://memory', 'w'); 

    $fields = array('First Name','Last Name','Mobile Number','Office Number','Email','Instagram Id','Twitter Id','Linkedin Id','Facebook Id');
    fputcsv($f, $fields, $delimiter);           //to write the column headers
    while($row = $query->fetch_assoc()){

        $lineData = array($row['first_name'],$row['last_name'],$row['mobile_number'],$row['office_number'],
        $row['email_id'],$row['instagram_id'],$row['twitter_id'],$row['linkedin_id'],$row['facebook_id']);

    fputcsv($f, $lineData, $delimiter); //writes the current row to the CSV file 

    }
    fseek($f, 0);               //moves the file pointer back to the beginning of the file

    header('Content-Type: text/csv');       //HTTP header for the response to indicate that it's a CSV file
    header('Content-Disposition: attachment; filename="' . $filename . '";');  //indicating that the file should be downloaded as an attachement

    fpassthru($f); //outputs the contents of the CSV file 

}
exit; 
?>