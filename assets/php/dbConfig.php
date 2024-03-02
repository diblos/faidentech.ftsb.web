<?php 
require_once 'constants.php';
// Database configuration 
$dbHost     = DB_SERVER;
$dbUsername = DB_USR;
$dbPassword = DB_PWD;
$dbName     = DB_NAME;
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}