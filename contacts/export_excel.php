<?php
include '../database/connections.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;


session_start();
$user_id = $_SESSION['user_id'];


function filterData($str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$fileName = "members-data_" . date('Y-m-d') . ".xlsx"; 
$fields = array('First Name','Last Name','Mobile Number','Office Number','Email','Instagram Id','Twitter Id','Linkedin Id','Facebook Id');
$query=$con->query ("SELECT * FROM contact_information WHERE is_deleted=0  AND user_id='$user_id' ORDER BY id DESC");
if($query->num_rows > 0){ 

    $objPHPExcel = new Spreadsheet();

    $objPHPExcel->getProperties()->setCreator("Your Name")
    ->setLastModifiedBy("Your Name")
    ->setTitle("Members Data")
    ->setSubject("Members Data")
    ->setDescription("Members Data")
    ->setKeywords("members, data")
    ->setCategory("Data");

    $objPHPExcel->setActiveSheetIndex(0);
    $col = 'A';
    foreach ($fields as $field) {
        $objPHPExcel->getActiveSheet()->setCellValue($col.'1', $field);
        $col++;
    }

    $rowNum = 2;
    while($row = $query->fetch_assoc()){ 

        $lineData = array($row['first_name'],$row['last_name'],$row['mobile_number'],$row['office_number'],
        $row['email_id'],$row['instagram_id'],$row['twitter_id'],$row['linkedin_id'],$row['facebook_id']);


        array_walk($lineData, 'filterData'); 
        $col = 'A';
        foreach ($lineData as $cellValue) {
            $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNum, $cellValue);
            $col++;
        }

        $rowNum++;

    }
    ob_clean();
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Cache-Control: max-age=0");
    $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
    $objWriter->save('php://output');
    exit;

}
?>
