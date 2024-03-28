<?php
$recordcount = 0;
?>
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
?>
    <!-- RECORD / EXPORT  -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

<?php
include 'topnav.php';
?>

<?php
require '../assets/php/categories.php';
// ITREATE THROUGH UNAUTHORIZED ARRAY AND PUSH TO AUTHORIZED ARRAY
foreach($optionsUC as $option) {
    array_push($options, $option);
}

?>
        <div class="container-fluid pt-4 px-0">
            <div class="login-box">
                <!-- <h2>Record</h2> -->
                <h2>Report</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                    <div class="user-box">
                        <label></label>
                    </div>
                    <h5 style="color:white;">Select Required Date Range</h5>
                    <div class="user-box row">
                        <div class="col-1 text-white p-2">From:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="date" name="datestart" required="" id="datestart" class="form-control">
                            </div>
                        </div>
                        <div class="col-1 text-white p-2">to:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="date" name="dateend" required="" id="dateend" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="user-box row">
                        <div class="col-1 text-white p-2">License:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="license" id="license" class="form-control">
                            </div>
                        </div>
                        <div class="col-1 text-white p-2">Name:</div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 text-white p-2">Category:</div>
                        <div class="col">
                            <div class="form-group">
                                <select name="containt" id="input-2" class="form-control" style="background-color: rgba(0,0,0,.3);">
                                
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
                        <div class="col p-0" style="text-align:right;">
                        <a href="#" class="m-0">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <button type="submit" class="btn btn-light px-5 m-0"><i class="fa fa-eye"></i> Show</button>
                        </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <section class="login-box container-fluid py-1 my-4">
            <!--for demo wrap-->
            <h1 style="color:white">Record<?php 
              $name = isset($_POST["name"])? test_input($_POST["name"]) : null;
              $license = isset($_POST["license"])?test_input($_POST["license"]):null;
              $newdatestart = "";
              $newdateend = "";
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  $containt = test_input($_POST["containt"]);
                  
                  $datestart = strtotime($_POST['datestart']);
                  $dateend = strtotime($_POST['dateend']);
                  
                  if ($datestart) {
                    $newdatestart = date('d/m/Y', $datestart);
                    $newdateend = date('d/m/Y', $dateend);
                    echo ' - ' . $containt . ' (' . $newdatestart . ' - ' . $newdateend . ')';
                    // echo '(' . $newdatestart . ' - ' . $newdateend . ')';
                  } else {
                    echo ' - Invalid Date: ' . $_POST['$datestart'];
                  }
                  // echo $containt.$datestart;
              } 
            ?></h1>
           
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th class="w10 p-2">No</th>
                            <th class="w10 p-2">License</th>
                            <th class="p-2">Name</th>
                            <th class="w10 p-2">Category</th>
                            <th class="w20 p-2">Time</th>
                            <th class="w10 p-2">Gate</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php
                        // define variables and set to empty values
                    $newdatestart = $containt = "";
                    $newdateend = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $containt = test_input($_POST["containt"]);
                      $datestart = strtotime($_POST['datestart']);
                      $dateend = strtotime($_POST['dateend']);
                      //echo $containt;
                    if ($datestart) {
                      $newdatestart = date('Y-m-d', $datestart);
                      $newdateend = date('Y-m-d', $dateend);
                      //echo $newdatestart;
                    } else {
                       echo 'Invalid Date: ' . $_POST['$datestart'];
                      // fix it
                    }

                    require_once '../assets/php/database.php';
                    require_once '../assets/php/common.php';

                        // $get = "SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' ORDER BY id DESC";



                        $filter = $containt=='Others' || $containt=='' ? "status!='Un-Authorized'" : "status='".$containt."'";
                        // $get = "SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
                        //   "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
                        //   " ORDER BY time DESC";

                        

                        if($name=='' && $license==''){
                            $get = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
                            "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
                            ") as U ORDER BY time DESC";
                        } else {
                            // $get = "SELECT U.*, R.name FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
                            // "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
                            // ") as U CROSS JOIN registered as R WHERE U.license = R.license ORDER BY time DESC";
                            $f1 = $name==''?'':' HAVING UPPER(name) LIKE "%'.strtoupper($name).'%"';
                            $f2 = $license==''?'':' AND UPPER(U.license) LIKE "%'.strtoupper($license).'%"';

                            $get = "SELECT U.*, (SELECT R.name from registered as R WHERE U.license = R.license LIMIT 1) AS name FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' UNION " .
                            "SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE ".$filter." AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "'" .
                            ") as U WHERE 1=1".$f2.$f1." ORDER BY time DESC";

                        }

                        // WHERE 1=1".$f1.$f2.$f3."
                        // echo '<tr><td colspan="6">'.$get.'</td></tr>';

                        $getData = $conn->query($get);

                        $recordcount = $getData->num_rows;

                        if ($getData->num_rows > 0) {
                            $rownum = 1;
                            while ($row = $getData->fetch_assoc()) {
                                $license = $row["license"];
                                $name = $row["name"];
                                $status = $row["status"];
                                $found = find($options, 'value', $status);
                                $statusV = $found==null? $status : $found->label;
                                $datestart = $row["time"];
                                $dtable = $row["dtable"];

                                
                                echo '<tr> 
                                        <td class="w10">' . $rownum++ . '</td>
                                        <td class="w10">' . $license . '</td> 
                                        <td>' . $name . '</td> 
                                        <td class="w10">' . $statusV . '</td> 
                                        <td class="w20">' . $datestart . '</td>
                                        <td class="w10">' . $dtable . '</td>
                                    </tr>';
                            }
                        } else {
                          echo '<tr> 
                          <td colspan="6"> No Records </td>
                          </tr>';
                        }

                    // if ($containt == 'Entrance'){
                    //     $get = "SELECT DISTINCT * FROM `gate_in` WHERE status!='Un-Authorized' AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' ORDER BY id DESC";

                    //     $getData = $conn->query($get);

                    //     if ($getData->num_rows > 0) {
                    //         while ($row = $getData->fetch_assoc()) {
                    //             $license = $row["license"];
                    //             $status = $row["status"];
                    //             $datestart = $row["time"];

                    //             //echo json_encode($row);
                    //             //print_r($row);
                    //             echo '<tr> 
                    //                     <td>' . $license . '</td> 
                    //                     <td>' . $status . '</td> 
                    //                     <td>' . $datestart . '</td> 
                    //                 </tr>';
                    //         }
                    //     } else {
                    //       echo '<tr> 
                    //       <td colspan="3"> No Records </td>
                    //       </tr>';
                    //     }

                    // }

                    // if ($containt == 'Exit'){
                        
                    //     $get = "SELECT DISTINCT * FROM `gate_out` WHERE status!='Un-Authorized' AND DATE(time) BETWEEN '" . $newdatestart . "' AND '" . $newdateend . "' ORDER BY id DESC";

                    //     $getData = $conn->query($get);

                    //     if ($getData->num_rows > 0) {
                    //         while ($row = $getData->fetch_assoc()) {
                    //             $license = $row["license"];
                    //             $status = $row["status"];
                    //             $datestart = $row["time"];

                    //             //echo json_encode($row);
                    //             //print_r($row);
                    //             echo '<tr> 
                    //                     <td>' . $license . '</td> 
                    //                     <td>' . $status . '</td> 
                    //                     <td>' . $datestart . '</td> 
                    //                 </tr>';
                    //         }
                    //     } else {
                    //       echo '<tr> 
                    //       <td colspan="3"> No Records </td>
                    //       </tr>';
                    //     }

                    // }

                    }

                        ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col pt-3 pb-0">
                    <form method="post" action="../assets/php/export.php">
                        <input type="hidden" name="name" value="<?php echo isset($_POST["name"])? test_input($_POST["name"]) : null; ?>" id="input-1">
                        <input type="hidden" name="license" required="" value="<?php echo isset($_POST["license"])? test_input($_POST["license"]) : null; ?>" id="input-1">
                        <input type="hidden" name="datestart" required="" value="<?php echo isset($_POST["datestart"])? $_POST["datestart"] : null; ?>" id="input-1">
                        <input type="hidden" name="dateend" required="" value="<?php echo isset($_POST["dateend"])? $_POST["dateend"] : null; ?>" id="input-1">
                        <input type="hidden" name="containt" required="" value="<?php echo isset($_POST["containt"])? $_POST["containt"] : null; ?>" id="input-2">
                        <button type="submit" class="btn btn-success px-5" <?php echo $recordcount>0?'':'disabled' ?>><i class="fa fa-file-download"></i> Download</button>
                    </form>
                </div>
            </div>
        </section>
        </div>


        <?php
        // echo $recordcount;
        ?>
        <div class="row"><div class="col py-2"></div></div>

        </div>

<?php
    include 'footer.php';
?>

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
</body>

</html>