<?php
require '../assets/php/database.php';

    $get = "SELECT * FROM `gate_in` WHERE status="staff" OR status="contractor" OR status="Registered-Visitor" ORDER BY `id` DESC LIMIT 10";
    $getData = $conn->query($get);

    if ($getData->num_rows > 0) {
        while ($row = $getData->fetch_assoc()) {
            $name = $row["name"];
            $phone = $row["phone"];
            $license = $row["license"];
            $category = $row["category"];

            //echo json_encode($row);
            //print_r($row);


            echo '<tr> 
                  <td>' . $name . '</td> 
                  <td>' . $phone . '</td> 
                  <td>' . $license . '</td> 
                  <td>' . $category . '</td>
              </tr>';
        }
    }


?>
