<?php
 require_once('../dbconnection.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user and role IDs from the form
  $user_id = $_POST['user'];
  $role_id = $_POST['role'];

  // Check if the user already has the role
  $sql = "SELECT COUNT(*) FROM user_roles WHERE user_id = $user_id AND role_id = $role_id";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_fetch_array($result)[0];

  if ($count > 0) {
    // User already has the role, display error message
    echo 'User already has the selected role.';
  } else {
    // Assign the role to the user
    $sql = "INSERT INTO user_roles (user_id, role_id) VALUES ($user_id, $role_id)";
    if (mysqli_query($conn, $sql)) {
      // Role assigned successfully, redirect to user management page
      header('Location: users.php');
      exit();
    } else {
      // Error assigning role, display error message
      echo 'Error assigning role: ' . mysqli_error($conn);
    }
  }
}
?>
