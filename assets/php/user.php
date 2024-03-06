<?php
/*

-- Create the `user` table
CREATE TABLE user (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  type VARCHAR(20) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create the `user_profiles` table
CREATE TABLE user_profiles (
  profile_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  bio TEXT,
  avatar_url VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES user(user_id)
);

-- Add an index on the username column for faster searches (optional)
ALTER TABLE user ADD INDEX (username);


INSERT INTO user (username, password, type)
VALUES ('Faiden', 'your_hashed_password', 'admin'),
       ('Operator1', 'your_hashed_password', 'user');

INSERT INTO user (username, password, type)
VALUES ('Operator2', 'your_hashed_password', 'user');

*/

// Path: assets/php/user.php
// Include the database configuration file

/*

password_hash()
password_verify()

*/

require_once 'database.php';
require_once 'common.php';

// create user function - password should be hashed before calling this function
function createUser($username, $password, $type) {
  global $conn;
  $query = "INSERT INTO user (username, password, type) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('sss', $username, $password, $type);
  $stmt->execute();
  $stmt->close();
}

// get user_id from username function
function getUserId($username) {
  global $conn;
  $query = "SELECT user_id FROM user WHERE username = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($user_id);
  $stmt->fetch();
  return $user_id;
}

// update user type function
function updateUserType($user_id, $type) {
  global $conn;
  $query = "UPDATE user SET type = ? WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $type, $user_id);
  $stmt->execute();
  $stmt->close();
  return true;
}

// change password function - password should be hashed before calling this function
function changePassword($user_id, $new_password) {
  global $conn;
  $query = "UPDATE user SET password = ? WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $new_password, $user_id);
  $stmt->execute();
  $stmt->close();
  return true;
}

// function to verify password
function verifyPassword($user_id, $password) {
  global $conn;
  $query = "SELECT password FROM user WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($hashed_password);
  $stmt->fetch();
  if ($stmt->num_rows == 1) {
    if (password_verify($password, $hashed_password)) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
  $stmt->close();
}

// login function
function login($username, $password) {
  global $conn;
  $query = "SELECT user_id, username, password, type FROM user WHERE username = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($user_id, $username, $hashed_password, $type);
  $stmt->fetch();
  if ($stmt->num_rows == 1) {
    if (password_verify($password, $hashed_password)) {
      // $_SESSION['user_id'] = $user_id;
      // $_SESSION['username'] = $username;
      // setcookie('ftype', $type, time() + (86400 * 30), "/");
      // header('location: index.php');
      return (object) [
        'id' => $user_id,
        'type' => $type
      ];
    } else {
      // echo 'Invalid username or password';
      throw new Exception("Wrong password!", 1);
    }
  } else {
    // echo 'Invalid username or password';
    // throw new Exception("User not exists!", 1);
    return false;
  }
  $stmt->close();
}

// function to list all profile
function listAllProfiles() {
  global $conn;
  $query = "SELECT P.*,U.* FROM user_profiles AS P JOIN user AS U ON P.user_id = U.user_id";
  $result = $conn->query($query);
  return $result;
}

// function to load a profile
function loadProfile($user_id) {
  global $conn;
  $query = "SELECT user_id, first_name, last_name, bio, avatar_url FROM user_profiles WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($user_id, $first_name, $last_name, $bio, $avatar_url);
  $stmt->fetch();
  $profile = [
    'user_id' => $user_id,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'bio' => $bio,
    'avatar_url' => $avatar_url
  ];
  return $profile;
}

// create profile function
function createProfile($user_id, $first_name, $last_name, $bio, $avatar_url) {
  global $conn;
  $query = "INSERT INTO user_profiles (user_id, first_name, last_name, bio, avatar_url) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('issss', $user_id, $first_name, $last_name, $bio, $avatar_url);
  $stmt->execute();
  $stmt->close();
}

// update profile function
function updateProfile($user_id, $first_name, $last_name, $bio, $avatar_url) {
  global $conn;
  $query = "UPDATE user_profiles SET first_name = ?, last_name = ?, bio = ?, avatar_url = ? WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ssssi', $first_name, $last_name, $bio, $avatar_url, $user_id);
  $stmt->execute();
  $stmt->close();
  return true;
}

// load name from profile
function loadName($user_id) {
  global $conn;
  $query = "SELECT first_name, last_name FROM user_profiles WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($first_name, $last_name);
  $stmt->fetch();
  $name = joinStrings(' ', $first_name, $last_name);
  return $name;
}

function updateName($user_id, $first_name, $last_name) {
  global $conn;
  $query = "UPDATE user_profiles SET first_name = ?, last_name = ? WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ssi', $first_name, $last_name, $user_id);
  $stmt->execute();
  $stmt->close();
  return true;
}

?>