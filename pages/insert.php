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
$license = $_POST['license'];
$category = $_POST['category'];

$update = "INSERT INTO registered (name, license, category) VALUES ('$name', UPPER('$license'), '$category');";
  $conn->query($update);

  if($fid){
    addUserActivity($fid, 'register authorize',strtoupper($license));
  }

  $conn->close();

  header("Location: register_1.php");

?>