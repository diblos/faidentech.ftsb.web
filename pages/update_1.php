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
$id = $_POST['id'];

if($fid){
    addUserActivity($fid, 'update authorize',$id);
}

$update = "UPDATE registered SET name='$name', license='$license', category='$category' WHERE id='$id';";
$conn->query($update);

$conn->close();

header("Location: register_1.php");

?>