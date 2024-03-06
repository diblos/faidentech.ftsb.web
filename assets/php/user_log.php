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

?>