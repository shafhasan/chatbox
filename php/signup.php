<?php
session_start();
include_once 'config.php';
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // filters the $email for invalid email addresses
    $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) { // if duplicate email exists
      echo "$email - already exists";
    } else { // if duplicate email does not exist
      if (isset($_FILES['image'])) { // if file is submitted
        $img_name = $_FILES['image']['name']; // get user uploaded img name
        $tmp_name = $_FILES['image']['tmp_name']; // temp name used to save/move file in our folder

        $img_explode = explode('.', $img_name); // explode breaks string into array
        $img_ext = end($img_explode); // end gives last element of the array, which is the file ext

        $extensions = ['png', 'jpeg', 'jpg'];
        if (in_array($img_ext, $extensions) === true) { // checks if the user ext matches ext in $extensions
          $time = time();
          $new_img_name = $time . $img_name; // creates unique filename with the timestamp

          if (move_uploaded_file($tmp_name, 'images/' . $new_img_name)) { // move user uploaded image successfully to images folder
            $status = "Active Now"; // status of user after signup
            $random_id = rand(time(), 10000000); // generating random userid

            // insert user data in the table
            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

            if ($sql2) { // if data is successfully inserted
              $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
              if (mysqli_num_rows($sql3) > 0) {
                $row = mysqli_fetch_assoc($sql3); // converts the row into associative array
                $_SESSION['unique_id'] = $row['unique_id']; // user unique_id from this session is used in other php file
                echo 'Success';
              }
            } else {
              echo 'Something went wrong';
            }
          }
        } else {
          echo 'Please select a JPG/JPEG/PNG file';
        }
      } else {
        echo 'Please select an image file';
      }
    }
  } else {
    echo "$email - is not a valid email";
  }
} else {
  echo 'All fields must be filled';
}
