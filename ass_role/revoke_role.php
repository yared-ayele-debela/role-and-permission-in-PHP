<?php
// Include the database connection
require_once('../dbconnection.php');

// Get user ID and role ID from the query string
$user_id = $_GET['user_id'];
$role_id = $_GET['role_id'];

// Remove the user's role from the database
$sql = "DELETE FROM user_roles WHERE user_id = $user_id AND role_id = $role_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<p>Role revoked successfully.</p>";
} else {
    echo "<p>Error revoking role: " . mysqli_error($conn) . "</p>";
}
?>

<p><a href="users.php">Back to users</a></p>
