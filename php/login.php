<?php
session_start();
include_once 'config.php';
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
  // check if entered email and pass matches any row from the users table
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'");
  if (mysqli_num_rows($sql) > 0) { // if user email and password matches
    $row = mysqli_fetch_assoc($sql);
    $status = 'Active Now';
    // updating user status to Active now if successful login
    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
    if ($sql2) {
      $_SESSION['unique_id'] = $row['unique_id']; // this unique_id is used in other php files
      echo 'Success';
    }
  } else {
    echo 'Email or Password is incorrect';
  }
} else {
  echo 'All input fields are required';
}
