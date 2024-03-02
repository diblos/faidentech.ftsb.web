<?php
require 'database.php';

    $get = "SELECT DISTINCT variant, timestamp FROM visitor_record WHERE status='in' AND DATE(timestamp) = CURDATE() AND timestamp <= CURRENT_TIMESTAMP ORDER BY id DESC LIMIT 4";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $variant = $row["variant"];
            $time = $row["timestamp"];

            //echo json_encode($row);
            //print_r($row);


            echo '<div class="timeline-block mb-3">
            <span class="timeline-step">
              <i class="ni ni-credit-card text-warning text-gradient"></i>
            </span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">'. $variant .'</h6>
              <p><img class="image4" src="../visitor/'. $variant .'.jpg"/> <img class="image4" src="../visitor_license/'. $variant .'.jpg"/></p>
              <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'. strtoupper(date("d M g:i A", strtotime($time))) .'</p>
            </div>
          </div>';
        }
    } else {
      echo '<div class="timeline-block mb-3">
      <div class="timeline-content">
        no records
      </div>
      </div>';
    }


?>
