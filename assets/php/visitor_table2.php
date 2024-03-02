<?php
require 'database.php';

    $time2 = "";

    $categoriesstr = "UPPER(status)!='STAFF' AND 
    UPPER(status)!='CONTRACTOR' AND
    UPPER(status)!='VENDOR' AND
    UPPER(status)!='REGISTERED-VISITOR' AND
    UPPER(status)!='PEKERJA TASKA' AND
    UPPER(status)!='PEKERJA KAFETERIA' AND
    UPPER(status)!='KOPERASI' AND
    UPPER(status)!='DEWAN MAKAN' AND
    UPPER(status)!='CLEANER (CBBK)' AND
    UPPER(status)!='SECURITY' AND
    UPPER(status)!='KENDERAAN KMB' AND
    UPPER(status)!='RESIDENT' AND
    UPPER(status)!='UN-AUTHORIZED'
    ";

    $timestr = "AND DATE(time) = CURDATE()";
    // $timestr = "AND DATE(time) = '2024-02-08'"; // TESTING PURPOSES

    // $get = "SELECT DISTINCT variant, time FROM gate_in WHERE status!='Staff' AND status!='Contractor' AND status!='Un-Authorized' AND DATE(time) = CURDATE() ORDER BY id DESC"; // ORIGINAL
    // $get = "SELECT DISTINCT variant, time FROM gate_in WHERE ".$categoriesstr." AND variant!='' ".$timestr." ORDER BY id DESC"; // ORIGINAL MODIFIED
    $get = "SELECT DISTINCT gi.variant,gi.license, time, (SELECT MAX(time) FROM gate_out AS go WHERE go.variant=gi.variant) AS time2 FROM gate_in AS gi WHERE ".$categoriesstr." AND variant!='' ".$timestr." ORDER BY time DESC"; // MODIFIED

    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $variant = $row["variant"];
            $time = $row["time"];

            // ORIGINAL SECTION
            // $get2 = "SELECT time FROM gate_out WHERE variant='" . $variant . "' ORDER BY id DESC LIMIT 1";
            // $getData2 = $conn->query($get2);
            // if ($getData2->num_rows > 0) {
            //   while ($row2 = $getData2->fetch_assoc()) {
            //       $time2 = $row2["time"];
            //   }
            // }
            // ORIGINAL SECTION
            // MODIFIED SECTION
            $time2 = $row["time2"];
            // MODIFIED SECTION

            echo '
              <tr style="height: 8vh;">
              <td><h6 class="text-dark text-sm font-weight-bold mb-0">'. $variant .'</h6></td>
              <td><img class="image4" src="../visitor/'. $variant .'.jpg"/></td>
              <td><img class="image4" src="../visitor_license/'. $variant .'.jpg"/></td>
              <td><div class="text-secondary font-weight-bold text-xs mt-1 mb-0">'. strtoupper(date("d M g:i A", strtotime($time))) .'</div></td>';

            if ($time2){
              echo '<td><div class="text-secondary font-weight-bold text-xs mt-1 mb-0">'. strtoupper(date("d M g:i A", strtotime($time2))) .'</div></td>
              </tr>';
              $time2 = "";
            }
            else{
              echo '<td><div class="text-secondary font-weight-bold text-xs mt-1 mb-0">NONE</div></td>
              </tr>';
              $time2 = "";
            }
        }
    }

    //<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'. strtoupper(date("d M g:i A", strtotime($time))) .'</p>
?>
