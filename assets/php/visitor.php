<?php
require 'database.php';

    $get = "SELECT COUNT(DISTINCT variant) AS total FROM `gate_in` WHERE status='Visitor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            echo $total;
        }
    }


?>
