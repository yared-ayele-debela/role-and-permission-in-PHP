<?php
require_once('../dbconnection.php');
// Get permission name from POST data
$name = $_POST['name'];
// Add permission to database
$sql_permission = "INSERT INTO permissions (name) VALUES ('$name')";
$result_permission = mysqli_query($conn, $sql_permission);

// Redirect to permissions page
header("Location: permissions.php");
exit();
?>

<?php
// Close database connection
mysqli_close($conn);
?>
