<?php
require_once 'common.php';
require_once 'PhpXlsxGenerator.php'; 
require 'database.php';

    $time2 = "";

    $categoriesstr = "UPPER(status)!='STAFF' AND 
    UPPER(status)!='CONTRACTOR' AND
    UPPER(status)!='VENDOR' AND
    UPPER(status)!='REGISTERED-VISITOR' AND
    UPPER(status)!='PEKERJA TASKA' AND
    UPPER(status)!='PEKERJA KAFETERIA' AND
    UPPER(status)!='KOPERASI' AND
    UPPER(status)!='DEWAN MAKAN' AND
    UPPER(status)!='CLEANER (CBBK)' AND
    UPPER(status)!='SECURITY' AND
    UPPER(status)!='KENDERAAN KMB' AND
    UPPER(status)!='RESIDENT' AND
    UPPER(status)!='UN-AUTHORIZED'
    ";

    // Excel file name for download 

$fileName = 'visitor_record'.date('Ymd').'.xlsx';

// Define column names 
$excelData[] = array('NO', 'NAME', 'LICENSE PLATE', 'TIME-IN', 'TIME-OUT'); 

$timestr = "AND DATE(time) = CURDATE()";
// $timestr = "AND DATE(time) = '2024-02-08'"; // TESTING PURPOSES

$get = "SELECT DISTINCT gi.variant,gi.license, time, (SELECT MAX(time) FROM gate_out AS go WHERE go.variant=gi.variant) AS time2 FROM gate_in AS gi WHERE ".$categoriesstr." AND variant!='' ".$timestr." ORDER BY time DESC"; // MODIFIED

// TESTING PURPOSES >>>>
// echo $get;
// exit;
// TESTING PURPOSES <<<<

$getData = $conn->query($get);

$rownum = 1;
if ($getData->num_rows > 0) {
  while ($row = $getData->fetch_assoc()) {
      $lineData = array($rownum++, $row["variant"], $row['license'], $row['time'], $row['time2']);  
      $excelData[] = $lineData;
  }
}


// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
?>
