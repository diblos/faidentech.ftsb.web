<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 
$name = isset($_POST["name"])? test_input($_POST["name"]) : null;
$license = isset($_POST["license"])?test_input($_POST["license"]):null;
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
$excelData[] = array('NO', 'LICENSE', 'NAME', 'CATEGORY', 'TIME', 'GATE'); 
 
// Fetch records from database and store in an array 

// if ($containt == 'Entrance'){
//     $query = $db->query("SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' ORDER BY id DESC"); 
//     if($query->num_rows > 0){ 
//         while($row = $query->fetch_assoc()){ 
//             $lineData = array($row['license'], $row['status'], $row['time']);  
//             $excelData[] = $lineData; 
//         } 
//     } 
// }

// if ($containt == 'Exit'){
//     $query = $db->query("SELECT DISTINCT * FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' ORDER BY id DESC"); 
//     if($query->num_rows > 0){ 
//         while($row = $query->fetch_assoc()){ 
//             $lineData = array($row['license'], $row['status'], $row['time']);  
//             $excelData[] = $lineData; 
//         } 
//     } 
// }

    $filter = $containt=='Others' || $containt=='' ? "status!='Un-Authorized'" : "status='".$containt."'";
    // $sql = "SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
    // "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
    // " ORDER BY time DESC";

    

    // $sql = "SELECT U.*, R.name FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
    //       "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
    //       ") as U CROSS JOIN registered as R WHERE U.license = R.license ORDER BY time DESC";

    if($name=='' && $license==''){
      $sql = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
      "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
      ") as U ORDER BY time DESC";
    } else {
        // $get = "SELECT U.*, R.name FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
        // "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
        // ") as U CROSS JOIN registered as R WHERE U.license = R.license ORDER BY time DESC";
        $f1 = $name==''?'':' HAVING UPPER(name) LIKE "%'.strtoupper($name).'%"';
        $f2 = $license==''?'':' AND UPPER(U.license) LIKE "%'.strtoupper($license).'%"';

        $sql = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
        "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
        ") as U WHERE 1=1".$f2.$f1." ORDER BY time DESC";

    }

    $query = $db->query($sql);
    if($query->num_rows > 0){ 
        $rownum = 1;
        while($row = $query->fetch_assoc()){ 
            $lineData = array($rownum++, $row['license'], $row['name'], $row['status'], $row['time'], $row['dtable']);  
            $excelData[] = $lineData; 
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
 