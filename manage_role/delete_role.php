<?php
require_once('../dbconnection.php');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get role ID from URL parameter
$role_id = $_GET['id'];

// Delete role from database
$sql_role = "DELETE FROM roles WHERE id = " . $role_id;
$result_role = mysqli_query($conn, $sql_role);

// Delete role permissions from database
$sql_role_permissions = "DELETE FROM role_permissions WHERE role_id = " . $role_id;
$result_role_permissions = mysqli_query($conn, $sql_role_permissions);

// Redirect to roles page
header("Location: roles.php");
exit();
?>

<?php
// Close database connection
mysqli_close($conn);
?>
