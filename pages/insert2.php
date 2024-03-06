<?php
ob_start(); 
$cookie_name = "fid";
$fid = null;
if(!isset($_COOKIE[$cookie_name])) {
    $fid = null;
  } else {
    $fid = $_COOKIE[$cookie_name];
  }

require_once '../assets/php/database.php';
require_once '../assets/php/user_log.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$license = $_POST['license'];
$purpose = $_POST['purpose'];
$time_limit = $_POST['time'];
$expired_date = $_POST['date'];

$update = "INSERT INTO visitor_register (name, phone, license, purpose, time_limit, expired_date) VALUES ('$name', '$phone', UPPER('$license'), '$purpose', '$time_limit', '$expired_date');";
$conn->query($update);

if($fid){
  addUserActivity($fid, 'register contractor',strtoupper($license));
}

$conn->close();

header("Location: register_2.php");

?>