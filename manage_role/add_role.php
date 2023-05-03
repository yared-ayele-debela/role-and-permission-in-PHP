<?php
require_once('../dbconnection.php');
if($_POST) {
  $name = $_POST['name'];
  $permissions = $_POST['permissions'];

  // Insert new role into the database
  $sql = "INSERT INTO roles (name) VALUES ('$name')";
  mysqli_query($conn, $sql);

  // Get ID of new role
  $role_id = mysqli_insert_id($conn);

  // Insert role permissions into the database
  foreach($permissions as $permission_id) {
    $sql = "INSERT INTO role_permissions (role_id, permission_id) VALUES ($role_id, $permission_id)";
    mysqli_query($conn, $sql);
  }

  // Redirect to roles page
  header("Location: roles.php");
  exit;
}
?>
