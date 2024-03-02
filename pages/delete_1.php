<?php
require '../assets/php/database.php';

$id = $_GET['id'];
$update = "DELETE from registered WHERE id='$id'";

$conn->query($update);

$conn->close();

header("Location: register_1.php");

?>