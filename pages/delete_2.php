<?php
require '../assets/php/database.php';

$id = $_GET['id'];
$update = "DELETE from visitor_register WHERE id='$id'";

$conn->query($update);

$conn->close();

header("Location: register_2.php");

?>