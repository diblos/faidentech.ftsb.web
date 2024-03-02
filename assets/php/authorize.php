<?php
require 'database.php';

    $staff = $contractor = $vendor = 0;

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='staff' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $staff = $row["total"];
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='contractor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $contractor = $row["total"];
        }
    }

    $get = "SELECT COUNT(DISTINCT license) AS total FROM `gate_in` WHERE status='vendor' AND DATE(time) = CURDATE();";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $vendor = $row["total"];
        }
    }

    echo $staff + $contractor + $vendor;

?>
