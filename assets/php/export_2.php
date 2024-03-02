<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 



$fname = isset($_POST["fname"])? test_input($_POST["fname"]) : null;
$flicense = isset($_POST["flicense"])? test_input($_POST["flicense"]):null;
$fcategory = isset($_POST["fcategory"])? test_input($_POST["fcategory"]):null;
$fdatestart = isset($_POST["fdatestart"])? strtotime($_POST["fdatestart"]):null;
$fdateend = isset($_POST["fdateend"])? strtotime($_POST["fdateend"]):null;

$new_date = $containt = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//$date = test_input($_POST["date"]);
$containt = test_input($_POST["containt"]);

$timestamp = time();
$currentDate = gmdate('Y-m-d', $timestamp);
// Excel file name for download 
$fileName = $containt . "_" . date('Y-m-d') . ".xlsx"; 

// Fetch records from database and store in an array 
// $timefilter = ($fdatestart=='' && $fdateend=='')?'DATE(time) = CURDATE()':'DATE(time) BETWEEN "'.date('Y-m-d', $fdatestart).'" AND "'.date('Y-m-d', $fdateend).'"';
$timefilter = ($fdatestart==null || $fdateend==null)?'DATE(time) = CURDATE()':'DATE(time) BETWEEN "'.date('Y-m-d', $fdatestart).'" AND "'.date('Y-m-d', $fdateend).'"';

$filter = $fcategory=='Others' || $fcategory=='' ? "status!='Un-Authorized'" : "status='".$fcategory."'";
$f1 = $fname==''?'':' HAVING UPPER(name) LIKE "%'.strtoupper($fname).'%"';
$f2 = $flicense==''?'':' AND UPPER(U.license) LIKE "%'.strtoupper($flicense).'%"';

$rownum = 1;
if ($containt == 'Entrance'){
    // Define column names 
    $excelData[] = array('NO' ,'LICENSE' ,'NAME' ,'CATEGORY', 'TIME'); 

    // $query = $db->query("SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC");
    $query = $db->query("SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT * FROM `gate_in` WHERE ".$filter." AND ".$timefilter.") as U WHERE 1=1".$f2.$f1." ORDER BY id DESC");

    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){ 
            $lineData = array($rownum++, $row['license'], $row['name'], $row['status'], $row['time']);  
            $excelData[] = $lineData; 
        } 
    } 
}

if ($containt == 'Exit'){
    // Define column names 
    $excelData[] = array('NO' ,'LICENSE' ,'NAME' ,'CATEGORY', 'TIME'); 

    // $query = $db->query("SELECT DISTINCT * FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC"); 
    $query = $db->query($get = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT * FROM `gate_out` WHERE ".$filter." AND ".$timefilter.") as U WHERE 1=1".$f2.$f1." ORDER BY id DESC"); 
    
    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){ 
            $lineData = array($rownum++, $row['license'], $row['name'], $row['status'], $row['time']);  
            $excelData[] = $lineData; 
        } 
    } 
}

if ($containt == 'Authorize'){
    // Define column names 
    $excelData[] = array('NO', 'LICENSE ', 'NAME', 'CATEGORY'); 

    // $query = $db->query("SELECT DISTINCT license, status FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC"); 
    $query = $db->query("SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT DISTINCT license, status FROM `gate_out` WHERE ".$filter." AND ".$timefilter.") as U WHERE 1=1".$f2.$f1.""); 

    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){ 
            // $lineData = array($rownum++, $row['license'], $row['name'], $row['status'], $row['time']);
            $lineData = array($rownum++, $row['license'], $row['name'], $row['status']);
            $excelData[] = $lineData; 
        } 
    } 
}

// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
 