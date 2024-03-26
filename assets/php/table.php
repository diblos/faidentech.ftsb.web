<?php
require 'database.php';
require_once 'categories.php';

    // $get = "SELECT * FROM `gate_in` WHERE 
    // status='staff' OR 
    // status='contractor' OR 
    // status='vendor' OR 
    // status='Registered-Visitor'  
    // ORDER BY `id` DESC LIMIT 10";

    $categoriesstr = "UPPER(status)='STAFF' OR 
    UPPER(status)='CONTRACTOR' OR 
    UPPER(status)='VENDOR' OR 
    UPPER(status)='REGISTERED-VISITOR' OR
    UPPER(status)='PEKERJA TASKA' OR
    UPPER(status)='PEKERJA KAFETERIA' OR
    UPPER(status)='KOPERASI' OR
    UPPER(status)='DEWAN MAKAN' OR
    UPPER(status)='CLEANER (CBBK)' OR
    UPPER(status)='SECURITY' OR
    UPPER(status)='KENDERAAN KMB' OR
    UPPER(status)='RESIDENT' OR
    UPPER(status)='VISITOR'
    ";

    $get = "SELECT U.* FROM (SELECT *, 'Entrance' AS dtable FROM `gate_in` WHERE 
    " . $categoriesstr . "
    UNION
    SELECT *, 'Exit' AS dtable FROM `gate_out` WHERE 
    " . $categoriesstr . ")
    as U ORDER BY time DESC LIMIT 10";

    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $name = $row["license"];
            $status = $row["status"];
            $time = $row["time"];
            $gate = $row["dtable"];

            //echo json_encode($row);
            // print_r($row);

            echo '<tr class="text-white"> 
                  <td>&nbsp;&nbsp; ' . $name . '</td> 
                  <td>' . $status . '</td> 
                  <td class="text-center">' . $time . '</td> 
                  <td class="text-center">' . $gate . '</td> 
              </tr>';
        }
    }


?>
