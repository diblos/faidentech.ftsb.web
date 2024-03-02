<?php
require 'database.php';

$visitor = $staff = $contractor = $vendor = 0;

    /*$get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_out` WHERE status='Un-Authorized' AND CHAR_LENGTH(license) > 6 AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $visitor = $total;
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_out` WHERE status='staff' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $staff = $total;
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_out` WHERE status='contractor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $contractor = $total;
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_out` WHERE status='vendor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $vendor = $total;
        }
    }

    echo $visitor + $staff + $contractor + $vendor*/

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_out` WHERE status!='Visitor' AND status!='Registered-Visitor' AND status!='Un-Authorized' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $staff = $total;
        }
    }

    $get = "SELECT COUNT(license) AS total FROM `gate_out` WHERE status='Visitor' OR status='Registered-Visitor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $visitor = $total;
        }
    }

    echo $staff + $visitor;

?>
