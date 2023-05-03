<?php
require_once('dbconnection.php');

if($_POST) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate input
  if($password != $confirm_password) {
    echo "Error: Passwords do not match";
    exit;
  }

  // Hash password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert user into database
  $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
  $result = mysqli_query($conn, $query);

  if($result) {
    echo "User registered successfully";
  } else {
    echo "Error registering user";
  }
}
?>
