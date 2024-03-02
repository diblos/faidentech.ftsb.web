
<?php
            require 'database.php';

            $variant = '';

            $get = "SELECT license FROM `visitor_register` WHERE time_limit<CURRENT_TIME OR expired_date<CURRENT_DATE;";
            $getData = $conn->query($get);

            if ($getData->num_rows > 0) {
                while ($row = $getData->fetch_assoc()) {
                    $license = $row["license"];

                    //$get2 = "SELECT variant FROM visitor_record WHERE status='in' AND license='". $license . "' LIMIT 1;";
                    $get2 = "SELECT * FROM visitor_record WHERE status='in' AND license!='' AND timestamp<now() LIMIT 1;";
                    $getData2 = $conn->query($get2);

                    if ($getData2->num_rows > 0) {
                        while ($row2 = $getData2->fetch_assoc()) {
                            $variant = $row2["variant"];
                        
                            //echo $variant;
                        }
                    }
                    else{
                        $get3 = "SELECT * FROM visitor_record WHERE status='in' AND timestamp<now() - interval 2 hour LIMIT 1;";
                        $getData3 = $conn->query($get3);
        
                        if ($getData3->num_rows > 0) {
                            while ($row3 = $getData3->fetch_assoc()) {
                                $variant = $row3["variant"];
                            
                                //echo $variant;
                            }
                        }
                        else{
                            //echo 'visitor_1';
                        }
                            
                    }
                }

            } 

            echo $variant;
            ?>

