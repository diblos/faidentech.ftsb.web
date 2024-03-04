<?php
$cookie_name = "ftype";
$ftype = 'user';

$parts = explode('/', $_SERVER["PHP_SELF"]);
$file = $parts[count($parts) - 1];

if(!isset($_COOKIE[$cookie_name])) {
    $ftype = 'user';
  } else {
    $ftype = $_COOKIE[$cookie_name];
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/css/img/faiden-logo.png">
  <title>
    Faidentech FTSB
  </title>

   <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
   <link href="../assets/css/font-awsome.css"/>
  <script src="../assets/js/core/kit-fontawesome.js" crossorigin="anonymous"></script>

  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link href="../assets/css/table.css" rel="stylesheet"/>

  <!--<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>-->
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.min.css?v=1.0.7" rel="stylesheet" />

  <script src="../assets/js/core/jquery-3.7.1.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
  
</head>

<body class="g-sidenav-show  bg-gray-100">

<!-- NAV STARTS -->

<?php
include 'nav.php';
?>

<!-- NAV ENDS -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

<?php
include 'topnav.php';
?>

<div class="container-fluid py-4"> 

        <div id="newForm" class="login-box">
            <h2>PROFILES</h2>
            <form action="insert.php" method="post">
                <div class="user-box">
                    <input type="text" name="name" required="" id="input-1">
                    <label>ENTER PERSON NAME</label>
                  </div>
                <div class="user-box">
                    <input type="text" name="license" required="" id="input-3">
                    <label>LICENSE PLATE</label>
                  </div>
                   <div class="row">
                   <div class="col-2">
                      <a href="#">
                        <input class="btn btn-light" type="button" value="Cancel" onclick="toggleObjectVisibility(`newForm`, false);">
                      </a>
                    </div>
                    <div class="col text-right">
                      <a href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <button type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Register</button>
                      </a>
                    </div>
                   </div>
                
            </form>
                
        </div>

        <div class="row py-1">
          <div class="col">&nbsp;</div>
        </div>

        <div id="newForm2" class="login-box">
            <h2>CHANGE PASSWORD</h2>
            <form action="insert.php" method="post">
                <div class="user-box">
                    <input type="text" name="name" required="" id="input-1">
                    <label>OLD PASSWORD</label>
                  </div>
                <div class="user-box">
                    <input type="text" name="license" required="" id="input-3">
                    <label>NEW PASSWORD</label>
                  </div>
                   <div class="row">
                   <div class="col-2">
                      <a href="#">
                        <input class="btn btn-light" type="button" value="Cancel" onclick="toggleObjectVisibility(`newForm`, false);">
                      </a>
                    </div>
                    <div class="col text-right">
                      <a href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <button type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Register</button>
                      </a>
                    </div>
                   </div>
                
            </form>
                
        </div>

</div>

  </main>

  <!-- <script src="../assets/js/visitor_table.js"></script>
  <script src="../assets/js/image.js"></script>
  <script src="../assets/js/image_1.js"></script>
  <script src="../assets/js/image_2.js"></script>
  <script src="../assets/js/table.js"></script> -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>