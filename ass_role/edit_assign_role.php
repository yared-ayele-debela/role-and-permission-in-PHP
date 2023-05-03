<?php
// Include database connection
require_once('../dbconnection.php');

// Fetch user and role IDs from query string
if (isset($_GET['user_id']) && isset($_GET['role_id'])) {
    $user_id = $_GET['user_id'];
    $role_id = $_GET['role_id'];
} else {
    header('Location: users.php');
    exit();
}

// Fetch user details from database
$sql_user = "SELECT * FROM users WHERE id = " . $user_id;
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Fetch role details from database
$sql_role = "SELECT * FROM roles WHERE id = " . $role_id;
$result_role = mysqli_query($conn, $sql_role);
$role = mysqli_fetch_assoc($result_role);

// Fetch all roles from the database
$sql_roles = "SELECT * FROM roles";
$result_roles = mysqli_query($conn, $sql_roles);

?>

<h2>Edit Assigned Role</h2>

<form action="update_assign_role.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" readonly>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" readonly>
    </div>
    <div>
        <label for="role">Role:</label>
        <select name="role">
            <?php while ($row = mysqli_fetch_assoc($result_roles)): ?>
                <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $role_id) echo 'selected'; ?>><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit">Update</button>
</form>
