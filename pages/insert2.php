<?php
ob_start(); 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SABS FIDENTECH: Record</title>
  <link rel="stylesheet" type="text/css" href="style.css">
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet"/>
    <script src="assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet"/>
</head>
<body>
    <div class="login-box">
        <h2>Successfuly Register :</h2>
        <br></br>
          <a>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
             <button onclick="<?php header("Location: register_2.php");?>" class="btn btn-light px-5">Return</button>
          </a>
		<h4><?php

require '../assets/php/database.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$license = $_POST['license'];
$purpose = $_POST['purpose'];
$time_limit = $_POST['time'];
$expired_date = $_POST['date'];

$update = "INSERT INTO visitor_register (name, phone, license, purpose, time_limit, expired_date) VALUES ('$name', '$phone', UPPER('$license'), '$purpose', '$time_limit', '$expired_date');";
$conn->query($update);

$conn->close();

header("Location: register_2.php");

?></h4>
      </div>
      <footer>
      <div class="footer-link padding-bottom--24">
        <!--<span>Don't have an account? <a href="">Sign up</a></span>-->
        <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
          <span><a href="#">© Faidentech</a></span>
          <span><a href="#">© Reiftech</a></span>
          <span><a href="https://faiden.com.my/">Contact</a></span>
          <span><a href="#">Privacy & terms</a></span>
        </div>
      </div>
    </footer>
</body>
</html>