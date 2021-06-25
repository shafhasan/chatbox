<?php
session_start();
include_once 'config.php';
$outgoing_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}"); // logged in user cannot see their name on the list
$output = "";
if (mysqli_num_rows($sql) == 1) { // if only one row is returned, it means that the logged in user is the only user in the database
  $output .= "No users are available to chat";
} elseif (mysqli_num_rows($sql) > 0) { // if not the only user, then return all users
  include 'data.php';
}
echo $output;
