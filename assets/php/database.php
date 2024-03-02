<?php
require_once 'constants.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
//echo date('d-m-Y H:i:s'); //Returns IST

$date = date('Ymd');

//function.php  
$servername = DB_SERVER;
// Your Database name
$dbname = DB_NAME;
// Your Database user
$username = DB_USR;
// Your Database user password
$password = DB_PWD;
$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn){
die('Oops! Something went wrong. Please try again later:' .mysql_error());
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows [""];
    while ( $row = mysqli_fetch_assoc($result) ) {
      $rows[] = $row;
    }
    return $rows;
  }
  
?>