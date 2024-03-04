<?php
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