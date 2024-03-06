<?php
/*
-- Create the `user_activities` table
CREATE TABLE user_activities (
  activity_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
  action VARCHAR(255) NOT NULL,
  target VARCHAR(255),
  data JSON,
  FOREIGN KEY (user_id) REFERENCES user(user_id)
);

-- Add an index on the username column for faster searches (optional)
ALTER TABLE user_activities ADD INDEX (user_id);

*/

require_once 'database.php';
require_once 'common.php';

// add user activity function
function addUserActivity($user_id, $action, $target = null, $data = null) {
  global $conn;
  $query = "INSERT INTO user_activities (user_id, action, target, data) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('isss', $user_id, $action, $target, $data);
  $stmt->execute();
  $stmt->close();
}

// get user activities function by date range
function getUserActivities($user_id, $start_date, $end_date) {
  global $conn;
  $query = "SELECT * FROM user_activities WHERE user_id = ? AND timestamp >= ? AND timestamp <= ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('iss', $user_id, $start_date, $end_date);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  return $result;
}

// get user activities function by fdatestart, fdateend, fname, funame, ftype
function getUserActivitiesByFilter($fdatestart, $fdateend, $fname, $funame, $ftype) {
  global $conn;

  $f1 = $fname==''?'':' AND UPPER(first_name) LIKE "%'.strtoupper($fname).'%"';
  $f2 = $funame==''?'':' AND UPPER(username) LIKE "%'.strtoupper($funame).'%"';
  $f3 = $ftype=='' || $ftype=='Others' ?'':' AND UPPER(type) LIKE "%'.strtoupper($ftype).'%"';

  $timefilter = ($fdatestart=='' && $fdateend=='')?'AND DATE(timestamp) = CURDATE()':'AND DATE(timestamp) BETWEEN "'.date('Y-m-d', $fdatestart).'" AND "'.date('Y-m-d', $fdateend).'"';

  $query = "SELECT UA.*,U.username,U.type,UP.first_name ".
  "FROM user_activities AS UA ".
  "CROSS JOIN user as U ".
  "CROSS JOIN user_profiles as UP ".
  "WHERE U.user_id = UA.user_id ".
  "AND U.user_id = UP.user_id ".$timefilter." ".$f1.$f2.$f3.
  "ORDER BY timestamp DESC";

  // echo $query;
  
  $getData = $conn->query($query);

  // $stmt->close();
  return $getData;
}

?>