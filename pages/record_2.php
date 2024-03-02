<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/css/img/faiden-logo.png">
    <title>
        Faidentech SABS
    </title>

    <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
    <link href="../assets/css/font-awsome.css" />
    <script src="../assets/js/core/kit-fontawesome.js" crossorigin="anonymous"></script>

    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link href="../assets/css/table.css" rel="stylesheet" />

    <!--<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>-->
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.min.css?v=1.0.7" rel="stylesheet" />

    <script src="../assets/js/core/jquery-3.7.1.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
</head>

<body class="g-sidenav-show  bg-gray-100">

<?php
include 'nav.php';
require '../assets/php/categories.php';
// ITREATE THROUGH UNAUTHORIZED ARRAY AND PUSH TO AUTHORIZED ARRAY
foreach($optionsUC as $option) {
    array_push($options, $option);
}
$rowcount = 0;
$fname = isset($_POST["fname"])? test_input($_POST["fname"]) : null;
$flicense = isset($_POST["flicense"])? test_input($_POST["flicense"]):null;
$fcategory = isset($_POST["fcategory"])? test_input($_POST["fcategory"]):null;
$fdatestart = isset($_POST["fdatestart"])? strtotime($_POST["fdatestart"]):null;
$fdateend = isset($_POST["fdateend"])? strtotime($_POST["fdateend"]):null;

$new_date = $containt = "";
$containt = isset($_POST["containt"])? test_input($_POST["containt"]):null;
?>    
    <!-- RECORD_2 / EXPORT_2  -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <section class="login-box container-fluid py-1">
            <!--for demo wrap-->
            <div class="row">
              <div class="col">
                <?php
                if($fdatestart=='' && $fdateend=='' ){
                  echo '<h1 style="color:white">Record - Today '.$containt.'</h1>';
                }else{
                  $newdatestart = date('d/m/Y', $fdatestart);
                  $newdateend = date('d/m/Y', $fdateend);
                  echo '<h1 style="color:white">Record - '.$containt.' (' . $newdatestart . ' - ' . $newdateend . ')</h1>';
                }
                ?>
              </div>
              <div class="col-3 text-right pt-3 pb-0" style="text-align: right;">
                <input class="btn btn-light mr-1" type="button" value="Filter" onclick="toggleObjectVisibility(`filter`, true);" title="Filter">
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
                        <div class="col-1 text-white p-2">License:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="flicense" id="flicense" class="form-control">
                            </div>
                        </div>
                        <div class="col-1 text-white p-2">Name:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="fname" id="fname" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 text-white p-2">Category:</div>
                        <div class="col">
                            <div class="form-group">
                                <select name="fcategory" id="input-2" class="form-control" style="background-color: rgba(0,0,0,.3);">
                                
                                    <option value="Others" selected>All</option>
                                    <?php
                                    foreach($options as $option) {
                                        echo '<option value="'.$option->value.'">'.$option->label.'</option>';
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
                            <th class="w5 p-2">No</th>
                            <th class="w10 p-2">License</th>
                            <th class="p-2">Name</th>
                            <th class="w15 p-2">Category</th>
                            <?php
                            if ($containt != 'Authorize'){
                                echo '<th class="w20 p-2">Time</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php
                        // define variables and set to empty values
                    $new_date = $containt = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $containt = test_input($_POST["containt"]);

                    require '../assets/php/database.php';
                    require_once '../assets/php/common.php';
                    // SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id ASC
                    // SELECT DISTINCT * FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC
                    // SELECT DISTINCT license, status FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC

                    $filter = $fcategory=='Others' || $fcategory=='' ? "status!='Un-Authorized'" : "status='".$fcategory."'";

                    $f1 = $fname==''?'':' HAVING UPPER(name) LIKE "%'.strtoupper($fname).'%"';
                    $f2 = $flicense==''?'':' AND UPPER(U.license) LIKE "%'.strtoupper($flicense).'%"';

                    $rownum = 1;
                    if ($containt == 'Entrance'){
                        // $get = "SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id ASC";
                        $timefilter = ($fdatestart=='' && $fdateend=='')?'DATE(time) = CURDATE()':'DATE(time) BETWEEN "'.date('Y-m-d', $fdatestart).'" AND "'.date('Y-m-d', $fdateend).'"';
                        $get = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT * FROM `gate_in` WHERE ".$filter." AND ".$timefilter.") as U WHERE 1=1".$f2.$f1." ORDER BY id DESC";

                        // echo '<tr><td colspan="6">'.$get.'</td></tr>';

                        $getData = $conn->query($get);

                        if ($getData->num_rows > 0) {
                            while ($row = $getData->fetch_assoc()) {
                                $license = $row["license"];
                                $status = $row["status"];
                                $found = find($options, 'value', $status);
                                $statusV = $found==null? $status : $found->label;

                                $name = $row["name"];
                                $time = $row["time"];

                                //echo json_encode($row);
                                //print_r($row);
                                echo '<tr>
                                      <th class="w5">'. $rownum++ .'</th>
                                      <td class="w10">' . $license . '</td> 
                                      <td>' . $name . '</td> 
                                      <td class="w15">' . $statusV . '</td>
                                      <td class="w20">' . $time . '</td>
                                    </tr>';
                            }
                        } else {
                          echo '<tr> 
                          <td colspan="5"> No Records </td>
                          </tr>';
                        }

                    }

                    if ($containt == 'Exit'){
                        // $get = "SELECT DISTINCT * FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC";
                        $timefilter = ($fdatestart=='' && $fdateend=='')?'DATE(time) = CURDATE()':'DATE(time) BETWEEN "'.date('Y-m-d', $fdatestart).'" AND "'.date('Y-m-d', $fdateend).'"';
                        $get = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT * FROM `gate_out` WHERE ".$filter." AND ".$timefilter.") as U WHERE 1=1".$f2.$f1." ORDER BY id DESC";
                        
                        // echo '<tr><td colspan="6">'.$get.'</td></tr>';

                        $getData = $conn->query($get);

                        if ($getData->num_rows > 0) {
                            while ($row = $getData->fetch_assoc()) {
                                $license = $row["license"];
                                $status = $row["status"];
                                $found = find($options, 'value', $status);
                                $statusV = $found==null? $status : $found->label;

                                $name = $row["name"];
                                $time = $row["time"];

                                //echo json_encode($row);
                                //print_r($row);
                                echo '<tr> 
                                      <th class="w5">'. $rownum++ .'</th>
                                      <td class="w10">' . $license . '</td> 
                                      <td>' . $name . '</td> 
                                      <td class="w15">' . $statusV . '</td>
                                      <td class="w20">' . $time . '</td>
                                    </tr>';
                            }
                        } else {
                          echo '<tr> 
                          <td colspan="5"> No Records </td>
                          </tr>';
                        }

                    }

                    if ($containt == 'Authorize'){
                        // $get = "SELECT DISTINCT license, status FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC";
                        $timefilter = ($fdatestart=='' && $fdateend=='')?'DATE(time) = CURDATE()':'DATE(time) BETWEEN "'.date('Y-m-d', $fdatestart).'" AND "'.date('Y-m-d', $fdateend).'"';
                        $get = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT DISTINCT license, status FROM `gate_out` WHERE ".$filter." AND ".$timefilter.") as U WHERE 1=1".$f2.$f1."";
                        
                        // echo '<tr><td colspan="6">'.$get.'</td></tr>';
                        
                        $getData = $conn->query($get);

                        if ($getData->num_rows > 0) {
                            while ($row = $getData->fetch_assoc()) {
                                $license = $row["license"];
                                $status = $row["status"];
                                $found = find($options, 'value', $status);
                                $statusV = $found==null? $status : $found->label;

                                $name = $row["name"];

                                //echo json_encode($row);
                                //print_r($row);
                                echo '<tr> 
                                        <th class="w5">'. $rownum++ .'</th>
                                        <td class="w10">' . $license . '</td> 
                                        <td>' . $name . '</td> 
                                        <td class="w15">' . $statusV . '</td>
                                    </tr>';
                            }
                        } else {
                          echo '<tr> 
                          <td colspan="4"> No Records </td>
                          </tr>';
                        }

                    }

                    }

                        function test_input($data) {
                          $data = trim($data);
                          $data = stripslashes($data);
                          $data = htmlspecialchars($data);
                          return $data;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
              <div class="col pt-3 pb-0">

                  <!-- DOWNLOAD -->
                  <form method="post" action="../assets/php/export_2.php">
<?php
$fds = isset($_POST["fdatestart"]) ? $_POST["fdatestart"] : null;
$fde = isset($_POST["fdateend"]) ? $_POST["fdateend"] : null;

echo '<input type="hidden" name="fdatestart" value="'.$fds.'">';
echo '<input type="hidden" name="fdateend" value="'.$fde.'">';
echo '<input type="hidden" name="fname" value="'.$fname.'" id="fname">';
echo '<input type="hidden" name="flicense" value="'.$flicense.'" id="flicense">';
echo '<input type="hidden" name="fcategory" value="'.$fcategory.'" id="fcategory">';

?>
                  <input type="hidden" name="containt" required="" value="<?php
                          if ($_SERVER["REQUEST_METHOD"] == "POST") {
                              $containt = test_input($_POST["containt"]);
                              echo $containt;
                          } ?>" id="input-1">
                  <!-- <button type="submit" class="btn btn-success px-5 <?php echo ($rowcount>0)? '':'disabled' ?>"><i class="fa fa-file-download"></i> Download</button> -->
                  <button type="submit" class="btn btn-success px-5"><i class="fa fa-file-download"></i> Download</button>
                  </form>

              </div>
            </div>

        </section>
        </div>

        <footer class="footer pt-3  " style="background-color: white; border-radius: 5px;">
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
    
    <!-- <script src="../assets/js/table.js"></script> -->
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