<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 

$newdatestart = $containt = "";
$newdateend = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //$date = test_input($_POST["date"]);
  $containt = test_input($_POST["containt"]);
  $datestart = strtotime($_POST['datestart']);
  $dateend = strtotime($_POST['dateend']);

//   echo $containt. " " . $datestart . " " . $dateend;
  
if ($datestart) {
  $newdatestart = date('Y-m-d', $datestart);
  $newdateend = date('Y-m-d', $dateend);
  //echo $newdatestart;
} else {
   echo 'Invalid Date: ' . $_POST['datestart']. ' ' . $_POST['dateend'];
  // fix it
}

// Excel file name for download 
$fileName = $containt . "_" . $newdatestart . "_".$newdateend.".xlsx"; 
 
// Define column names 
$excelData[] = array('LICENSE ', 'STATUS', 'TIME'); 
 
// Fetch records from database and store in an array 

if ($containt == 'Entrance'){
    // $query = $db->query("SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) = '" . $newdatestart . "' ORDER BY id DESC"); 
    $query = $db->query("SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' ORDER BY id DESC"); 
    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){ 
            $lineData = array($row['license'], $row['status'], $row['time']);  
            $excelData[] = $lineData; 
        } 
    } 
}

if ($containt == 'Exit'){
    // $query = $db->query("SELECT DISTINCT * FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) = '" . $newdatestart . "' ORDER BY id DESC"); 
    $query = $db->query("SELECT DISTINCT * FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' ORDER BY id DESC"); 
    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){ 
            $lineData = array($row['license'], $row['status'], $row['time']);  
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
 