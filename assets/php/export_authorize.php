<?php 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require_once 'common.php';

// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 

$ftype = isset($_POST["ftype"])? test_input($_POST["ftype"]) : null;
$fname = isset($_POST["fname"])? test_input($_POST["fname"]) : null;
$flicense = isset($_POST["flicense"])?test_input($_POST["flicense"]):null;
$fcategory = isset($_POST["fcategory"])?test_input($_POST["fcategory"]):null;

// Excel file name for download 
$fileName = joinStrings("_", $ftype, $fname, $flicense, $fcategory=='Others'?'All':'' );
$fileName = ($fileName==''?$ftype:$fileName).'.xlsx';

// Define column names 
$excelData[] = array('NO', 'NAME', 'LICENSE PLATE', 'CATEGORY'); 

$f1 = $fname==''?'':' AND UPPER(name) LIKE "%'.strtoupper($fname).'%"';
$f2 = $flicense==''?'':' AND UPPER(license) LIKE "%'.strtoupper($flicense).'%"';
$f3 = ($fcategory=='' || $fcategory=='Others')?'':' AND UPPER(category) LIKE "%'.strtoupper($fcategory).'%"';

if($fname=='' && $flicense=='' && $fcategory==''){
    $get = "SELECT * FROM `registered` ORDER BY id DESC";
} else {
    $get = "SELECT * FROM `registered` WHERE 1=1".$f1.$f2.$f3." ORDER BY id DESC";
}

$query = $db->query($get);
if($query->num_rows > 0){
    $rownum = 1;
    while($row = $query->fetch_assoc()){ 
        $lineData = array($rownum, $row['name'], $row['license'], $row['category']);  
        $excelData[] = $lineData;
        $rownum = $rownum + 1;
    }
} 

// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
?>

 