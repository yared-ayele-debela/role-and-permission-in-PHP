<?php
require_once('../dbconnection.php');

if($_POST) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if user exists in database
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 0) {
    echo "Error: User not found";
    exit;
  }

  // Verify password
  $row = mysqli_fetch_assoc($result);
  if(!password_verify($password, $row['password'])) {
    echo "Error: Incorrect password";
    exit;
  }

  // Start session and redirect to dashboard
  session_start();
  $_SESSION['user_id'] = $row['id'];
  header("Location: dashboard.php");
  exit;
}
?>
