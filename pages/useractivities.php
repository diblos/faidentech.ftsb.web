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

$cookie_name = "fid";
$fid = null;
if(!isset($_COOKIE[$cookie_name])) {
  $fid = null;
} else {
  $fid = $_COOKIE[$cookie_name];
}

require_once '../assets/php/common.php';
require_once '../assets/php/categories.php';
require_once '../assets/php/user_log.php';
$alert = false;

// get user activities function by fdatestart, fdateend, fname, funame, ftype
$f_name = isset($_POST["fname"])? test_input($_POST["fname"]) : null;
$f_uname = isset($_POST["funame"])? test_input($_POST["funame"]):null;
$f_type = isset($_POST["ftype"])? test_input($_POST["ftype"]):null;
$f_datestart = isset($_POST["fdatestart"])? strtotime($_POST["fdatestart"]):null;
$f_dateend = isset($_POST["fdateend"])? strtotime($_POST["fdateend"]):null;

$allprofiles = getUserActivitiesByFilter($f_datestart, $f_dateend, $f_name, $f_uname, $f_type);
$rowcount = $allprofiles->num_rows;

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

        <div class="login-box pb-3">
          <div class="row">
            <div class="col">
              <h2 style="text-align:left;">USER ACTIVITIES - <?php echo $rowcount; ?> Record(s)</h2>
            </div>
            <div class="col-2 p-0" style="text-align:right;">
              <a href="#">
                <input class="btn btn-light mr-1" type="button" value="Filter" onclick="toggleObjectVisibility(`filter`, true);" title="Filter">
              </a>
            </div>
          </div>

             <!-- FORM FILTER -->
             <form id="filter" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="d-none p-2">
              <input type="hidden" name="containt" value="<?php echo $containt ?>">
              <h5 style="color:white;">Select Required Date Range</h5>
                    <div class="user-box row">
                        <div class="col-1 text-white p-2">From:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="date" name="fdatestart" required="" id="fdatestart" class="form-control">
                            </div>
                        </div>
                        <div class="col-1 text-white p-2">to:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="date" name="fdateend" required="" id="fdateend" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="user-box row">
                        <div class="col-1 text-white p-2">Name:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="fname" id="fname" class="form-control">
                            </div>
                        </div>
                        <div class="col-1 text-white p-2">Username:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="funame" id="funame" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 text-white p-2">Category:</div>
                        <div class="col">
                            <div class="form-group">
                                <select name="ftype" id="input-2" class="form-control" style="background-color: rgba(0,0,0,.3);">
                                
                                    <option value="Others" selected>All</option>
                                    <?php
                                    foreach($utypes as $utype) {
                                        echo '<option value="'.$utype->value.'">'.$utype->label.'</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col">
                          <button type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Filter Search</button>
                      </div>
                    </div>
              </form>
            <!-- FORM FILTER -->

          <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
              <thead>
                <tr>
                  <th class="w5">#</th>
                  <th>Username</th>
                  <th class="w25">Name</th>
                  <th class="text-center">User Type</th>
                  <th class="w25 text-center">Timestamp</th>
                  <th class="w20">Action</th>
                </tr>
              </thead>
            </table>
          </div>

          <div class="tbl-content">
          <table cellpadding="0" cellspacing="0" border="0" class="table table-sm table-borderless">
            <tbody>
              <?php
              $rownum = 1;
              if ($allprofiles->num_rows > 0) {
                while ($row = $allprofiles->fetch_assoc()) {

                  $first_name = $row["first_name"];
                  $username = $row["username"];
                  $type = $row["type"];
                  $action = $row["action"];
                  $timestamp = $row["timestamp"];

                  echo '<tr>';
                  echo '<td class="w5">'.$rownum++.'</td>';
                  echo '<td>'.$username.'</td>';
                  echo '<td class="w25">'.$first_name.'</td>';
                  echo '<td class="text-center text-capitalize">'.$type.'</td>';
                  echo '<td class="w25 text-center">'.$timestamp.'</td>';
                  echo '<td class="w20">&nbsp;'.$action.'</td>';
                  echo '</tr>';

                }
              } else {
                echo '<tr>';
                echo '<td colspan="6">No records</td>';
                echo '</tr>';
              }
              ?>
            </tbody>
          </table>
          </div>

        </div>

        <div class="row">
              <div class="col pt-3 pb-0">

                  <!-- DOWNLOAD -->
                  <form method="post" action="../assets/php/export_user_activities.php">
<?php
$fds = isset($_POST["fdatestart"]) ? $_POST["fdatestart"] : null;
$fde = isset($_POST["fdateend"]) ? $_POST["fdateend"] : null;

echo '<input type="hidden" name="fdatestart" value="'.$fds.'">';
echo '<input type="hidden" name="fdateend" value="'.$fde.'">';
echo '<input type="hidden" name="fname" value="'.$f_name.'" id="fname">';
echo '<input type="hidden" name="funame" value="'.$f_uname.'" id="funame">';
echo '<input type="hidden" name="ftype" value="'.$f_type.'" id="ftype">';

?>
                  <button type="submit" class="btn btn-success px-5 <?php echo ($rowcount>0)? '':'disabled' ?>"><i class="fa fa-file-download"></i> Download</button>
                  </form>

              </div>
            </div>

        <div class="row py-1">
          <div class="col">&nbsp;</div>
        </div>

        <div class="row <?php echo ($msg != null) ? '' : 'd-none'; ?>">
          <div class="col pt-3">
            <div class="alert alert-<?php echo ($alert)?'danger':'success'; ?> text-white" role="alert">
              <?php echo $msg; ?>
            </div>
          </div>
        </div>

        

</div>

<?php
    include 'footer.php';
?>

  </main>

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
  <script src="../assets/js/common.js"></script>
</body>

</html>