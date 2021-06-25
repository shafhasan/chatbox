<?php
$conn = mysqli_connect('localhost', 'root', '', 'chat');
if (!$conn) {
  echo 'Database not connected' . mysqli_connect_error();
}
