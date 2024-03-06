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

$id = $_GET['id'];

$update = "DELETE from visitor_register WHERE id='$id'";
$conn->query($update);

if($fid){
    addUserActivity($fid, 'delete contractor',$id);
}

$conn->close();

header("Location: register_2.php");

?>