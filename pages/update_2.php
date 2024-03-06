<?php
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
$time_limit = $_POST['time_limit'];
$expired_date = $_POST['expired_date'];
$id = $_POST['id'];

if($fid){
    addUserActivity($fid, 'update contractor', $id);
  }

// $update = "INSERT INTO visitor_register (name, phone, license, purpose, time_limit, expired_date) VALUES ('$name', '$phone', '$license', '$purpose', '$time_limit', '$expired_date');";
// $conn->query($update);
$update = "UPDATE visitor_register SET name='$name', phone='$phone', license='$license', purpose='$purpose', time_limit='$time_limit', expired_date='$expired_date' WHERE id='$id';";
$conn->query($update);

$conn->close();

header("Location: register_2.php");

?>