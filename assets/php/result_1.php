<?php
require 'database.php';

    $get = "SELECT * FROM gate_out ORDER by id DESC LIMIT 1";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $license = $row["license"];
            $status = $row["status"];

            //echo json_encode($row);
            //print_r($row);


            echo 'Exit Cam : ' . $status;
        }
    }


?>
