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

<!-- 
  total ental
  total exit
  authorize
  visitor
 -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

<?php
include 'topnav.php';
?>

    <div class="container-fluid py-4">

    <div class="row">
    
                <div class="col"></div>

                <div class="col p-0">
                  <form method="post" action="../pages/record_2.php">
                  <input type="hidden" name="containt" required="" value="Entrance" id="input-1">
                  <button type="submit" class="btn btn-light btn-block">
                    <i class="fa fa-caret-right" aria-hidden="true"></i> <i  class="fa fa-car"></i> Total Entrance
                  </button></form>
                </div>

                <div class="col p-0">
                <form method="post" action="../pages/record_2.php">
                  <input type="hidden" name="containt" required="" value="Exit" id="input-1">
                  <button type="submit" class="btn btn-light btn-block">
                    <i class="fa fa-caret-left" aria-hidden="true"></i>   <i class="fa fa-car"></i> Total Exit
                  </button>
                </form>
                </div>

                <div class="col p-0">
                <form method="post" action="../pages/record_2.php">
                  <input type="hidden" name="containt" required="" value="Authorize" id="input-1">
                  <button type="submit" class="btn btn-light btn-block">
                  <i class="fa fa-id-card" aria-hidden="true"></i> Authorize
                  </button>
                </form>
                </div>

                <div class="col p-0">
                <form method="post" action="../pages/visitor.php">
                  <input type="hidden" name="containt" required="" value="Authorize" id="input-1">
                  <button type="submit" class="btn btn-light btn-block">
                  <i class="fa fa-user-plus" aria-hidden="true"></i> Visitor
                  </button>
                </form>
                </div>

                <div class="col"></div>
    
        </div>
      </div>

      <footer class="footer pt-3" style="background-color: white; border-radius: 5px;">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © 2023
                made with <img src="../assets/css/img/Reiftech.jpg" alt="" style="width:10px;"> Powered by <img src="../assets/css/img/faiden-logo_vectorized-glow.png" alt="" style="width:30%;">
                <a href="https://faiden.com.my/" class="font-weight-bold" target="_blank"></a>
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://faiden.com.my/" class="nav-link text-muted" target="_blank">Faiden Tech Team</a>
                </li>
                <li class="nav-item">
                  <a href="https://faiden.com.my/" class="nav-link text-muted" target="_blank">About
                    Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://faiden.com.my/talk-to-us/" class="nav-link text-muted" target="_blank">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
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