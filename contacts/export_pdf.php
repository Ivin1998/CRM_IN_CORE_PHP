<?php
include '../database/connections.php';
require '../vendor/autoload.php';

session_start();
$user_id = $_SESSION['user_id'];
function filterData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) {
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
}
$fileName = "members-data_" . date('Y-m-d') . ".pdf";
$fields = array('First Name','Last Name','Mobile Number','Office Number','Email','Instagram Id','Twitter Id','Linkedin Id','Facebook Id');
$query = $con->query ("SELECT * FROM contacts WHERE is_deleted=0 AND user_id='$user_id' ORDER BY id DESC");
if ($query->num_rows > 0) {
    // Create new PDF document
    $pdf = new \Mpdf\Mpdf();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ivin');
    $pdf->SetTitle('Members Data');
    $pdf->SetSubject('Members Data');
    $pdf->SetKeywords('Members, Data');
    // Add a page
    $pdf->AddPage('P', 'A4');
    // Add header
    $header = '<h1>Members Data</h1>';
    $pdf->writeHTML($header);
    // Add table
    $tableHeader = '<table border="1" style="border-collapse: collapse;"><tr>';
    foreach ($fields as $field) {
        $tableHeader .= '<th>'.$field.'</th>';
    }
    $tableHeader .= '</tr>';
    $pdf->writeHTML($tableHeader);
    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['first_name'], $row['last_name'], $row['mobile_number'], $row['office_number'], $row['email_id'], $row['instagram_id'], $row['twitter_id'], $row['linkedin_id'], $row['facebook_id']);
        array_walk($lineData, 'filterData');
        $tableRow = '<tr>';
        foreach ($lineData as $cellValue) {
            $tableRow .= '<td>'.$cellValue.'</td>';
        }
        $tableRow .= '</tr>';
        $pdf->writeHTML($tableRow);
    }
    $tableFooter = '</table>';
    $pdf->writeHTML($tableFooter);
    $pdf->Output($fileName, 'D');   // output PDF document 
}
exit;
?>