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
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script> 
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
</head>

<body class="g-sidenav-show  bg-gray-100">

<!-- NAV STARTS -->

<?php
include 'nav.php';
?>

<!-- NAV ENDS --> 

  <!-- VISITOR / Export2Doc >   -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

<?php
include 'topnav.php';
?>
   
      <!-- </div>
    </nav> -->

    <div class="container-fluid py-4">
      <div class="row">
      
        <div class="row my-4">
        <div class="col-lg-20">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Visitor Record</h6>
            </div>
            
            <div class="card-body p-3">
              <!-- <button class="btn btn-success px-5" onclick="Export2Doc('tbl_visitor', 'visitor')"><i class="fa fa-file-word mx-1"></i>Download</button> -->
              <!-- DOWNLOAD EXCEL HERE -->
              <form name="download" method="post" action="../assets/php/export_visitor_table2.php">
                <?php
                echo '<input type="hidden" name="ftype" value="authorized" id="ftype">';
                ?>
                <button type="submit" class="btn btn-success px-5"><i class="fa fa-file-excel mx-1"></i>Download</button>
              </form>
              <!-- DOWNLOAD EXCEL HERE -->
              <table id="tbl_visitor" border="1" style="table-layout: fixed; width: 100%; text-align: center; vertical-align: middle;">
	              <thead>
		              <th>NAME</th>
		              <th>CAR IMAGE</th>
		              <th>LICENSE IMAGE</th>
                  <th>TIME-IN</th>
                  <th>TIME-OUT</th>
	              </thead>
	              <tbody id="visitor_table">        
	              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </div>

<?php
    include 'footer.php';
?>

  </main>

  <script src="../assets/js/visitor_table2.js"></script>
  
  <script src="../assets/js/image.js"></script>
  <script src="../assets/js/image_1.js"></script>
  <script src="../assets/js/image_2.js"></script>
  <script src="../assets/js/table.js"></script>
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