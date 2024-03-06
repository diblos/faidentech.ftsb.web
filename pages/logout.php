<?php
include_once '../assets/php/user_log.php';

$cookie_name = "fid";
$fid = null;
if(!isset($_COOKIE[$cookie_name])) {
    $fid = null;
  } else {
    $fid = $_COOKIE[$cookie_name];
  }

  if($fid){
    addUserActivity($fid, 'logout');
  }

// Initialize the session.
session_start();
// Unset all of the session variables.
unset($_SESSION['username']);
// Finally, destroy the session.    
session_destroy();

setcookie('fid', "", time() - 3600, "/");
setcookie('ftype', "", time() - 3600, "/");

// Include URL for Login page to login again.
header("Location: ../index.php");
exit;
?>