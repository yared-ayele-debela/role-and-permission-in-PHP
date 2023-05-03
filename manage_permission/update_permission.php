<?php
// Create database connection
require_once('../dbconnection.php');

// Get permission ID and name from POST data
$permission_id = $_POST['id'];
$name = $_POST['name'];

// Update permission name in database
$sql_permission = "UPDATE permissions SET name = '$name' WHERE id = $permission_id";
$result_permission = mysqli_query($conn, $sql_permission);

// Redirect to permissions page
header("Location: permissions.php");
exit();
?>

<?php
// Close database connection
mysqli_close($conn);
?>
