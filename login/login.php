<?php
require_once('../dbconnection.php');
if (isset($_SESSION['user_id'])) {
  // User is logged in, display dashboard
  header("Location: dashboard.php");
  exit();
}
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
  $user_id=$_SESSION['user_id'];
  $sql = "SELECT r.name AS role, p.name AS permission
        FROM user_roles ur
        INNER JOIN roles r ON ur.role_id = r.id
        INNER JOIN role_permissions rp ON r.id = rp.role_id
        INNER JOIN permissions p ON rp.permission_id = p.id
        WHERE ur.user_id = $user_id";

      $result = mysqli_query($conn, $sql);

      // Create an array of the user's roles and permissions
      $user_roles = array();
      $user_permissions = array();

      while ($row = mysqli_fetch_assoc($result)) {
          $user_roles[] = $row['role'];
          $user_permissions[] = $row['permission'];
      }
      if (in_array('admin', $user_roles)&& in_array('add', $user_permissions)) {
        // User has admin role and view_reports permission
        header('Location: main.php');
        exit();
       }else{
        header("Location: dashboard.php");
        exit;
    }
}
?>
