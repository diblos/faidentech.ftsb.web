<?php
require 'database.php';

$visitor = $staff = $contractor = $vendor = $re_visitor = 0;

    /*$get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='Un-Authorized' AND CHAR_LENGTH(license) > 6 AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $visitor = $total;
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='Registered-Visitor' AND CHAR_LENGTH(license) > 6 AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $re_visitor = $total;
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='staff' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $staff = $total;
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='contractor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $contractor = $total;
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='vendor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $vendor = $total;
        }
    }

    echo $visitor + $re_visitor + $staff + $contractor + $vendor*/

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status!='Visitor' AND status!='Registered-Visitor' AND status!='Un-Authorized' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $staff = $total;
        }
    }

    $get = "SELECT COUNT(license) AS total FROM `gate_in` WHERE status='Visitor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $visitor = $total;
        }
    }

    $get = "SELECT COUNT(license) AS total FROM `gate_in` WHERE status='Registered-Visitor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $total = $row["total"];

            //echo json_encode($row);
            //print_r($row);


            $re_visitor = $total;
        }
    }

    echo $staff + $visitor + $re_visitor;

?>
