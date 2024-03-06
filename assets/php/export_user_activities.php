<?php 

require_once 'common.php';
require_once 'user_log.php';
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 

$fname = isset($_POST["fname"])? test_input($_POST["fname"]) : null;
$funame = isset($_POST["funame"])? test_input($_POST["funame"]):null;
$ftype = isset($_POST["ftype"])? test_input($_POST["ftype"]):null;
$fdatestart = isset($_POST["fdatestart"])? strtotime($_POST["fdatestart"]):null;
$fdateend = isset($_POST["fdateend"])? strtotime($_POST["fdateend"]):null;

$allprofiles = getUserActivitiesByFilter($fdatestart, $fdateend, $fname, $funame, $ftype);
$rowcount = $allprofiles->num_rows;

// Excel file name for download 
$fileName = joinStrings("_", $ftype, $fname, $flicense, $fcategory=='Others'?'All':'' );
$fileName = 'log_'.($fileName==''?$ftype:$fileName).'.xlsx';

// Define column names 
$excelData[] = array('NO', 'USERNAME', 'NAME', 'USER TYPE', 'TIMESTAMP', 'ACTION'); 

$allprofiles = getUserActivitiesByFilter($fdatestart, $fdateend, $fname, $funame, $ftype);
$rowcount = $allprofiles->num_rows;

$query = getUserActivitiesByFilter($fdatestart, $fdateend, $fname, $funame, $ftype);

if($query->num_rows > 0){
    $rownum = 1;
    while($row = $query->fetch_assoc()){ 
        $lineData = array($rownum++, $row["username"], $row['first_name'], $row['type'], $row['timestamp'], $row['action']);  
        $excelData[] = $lineData;
    }
} 

// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
?>

 