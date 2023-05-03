<?php
// Include database connection
require_once('../dbconnection.php');

// Fetch user and role IDs from post request
if (isset($_POST['user_id']) && isset($_POST['role'])) {
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role'];
} else {
    header('Location: users.php');
    exit();
}

// Update the user's assigned role in the database
$sql = "UPDATE user_roles SET role_id = $role_id WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

// Redirect to the users page
header('Location: users.php');
exit();

?>