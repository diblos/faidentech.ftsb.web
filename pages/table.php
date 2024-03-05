<?php
require '../assets/php/database.php';

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
UPPER(status)='RESIDENT'
";
// UPPER(status)='UN-AUTHORIZED'


    // ORIGINAL
    // $get = "SELECT * FROM `gate_in` WHERE status='staff' OR status='contractor' OR status='Registered-Visitor' ORDER BY `id` DESC LIMIT 10";

    $get = "SELECT * FROM `gate_in` WHERE ".$categoriesstr." ORDER BY `id` DESC LIMIT 10";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $name = $row["name"];
            $phone = $row["phone"];
            $license = $row["license"];
            $category = $row["category"];

            //echo json_encode($row);
            // print_r($row);

            echo '<tr> 
                  <td>' . $name . '</td> 
                  <td>' . $phone . '</td> 
                  <td>' . $license . '</td> 
                  <td>' . $category . '</td>
              </tr>';
        }
    }


?>
