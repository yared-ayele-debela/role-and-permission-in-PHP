<?php

require_once('../dbconnection.php');

// Get role ID and name from POST data
$role_id = $_POST['id'];
$name = $_POST['name'];

// Update role name in database
$sql_role = "UPDATE roles SET name = '$name' WHERE id = $role_id";
$result_role = mysqli_query($conn, $sql_role);

// Delete all existing role permissions from database
$sql_delete_role_permissions = "DELETE FROM role_permissions WHERE role_id = " . $role_id;
$result_delete_role_permissions = mysqli_query($conn, $sql_delete_role_permissions);

// Add new role permissions to database
if(isset($_POST['permissions'])) {
  $permissions = $_POST['permissions'];
  foreach($permissions as $permission_id) {
    $sql_role_permissions = "INSERT INTO role_permissions (role_id, permission_id) VALUES ($role_id, $permission_id)";
    $result_role_permissions = mysqli_query($conn, $sql_role_permissions);
  }
}

// Redirect to roles page
header("Location: roles.php");
exit();
?>

<?php
// Close database connection
mysqli_close($conn);
?>
