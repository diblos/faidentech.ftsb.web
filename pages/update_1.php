<?php

require '../assets/php/database.php';

$name = $_POST['name'];
$license = $_POST['license'];
$category = $_POST['category'];
$id = $_POST['id'];

$update = "UPDATE registered SET name='$name', license='$license', category='$category' WHERE id='$id';";
$conn->query($update);

$conn->close();

header("Location: register_1.php");

?>