<?php
// Include database connection
require_once('../dbconnection.php');

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Fetch all roles from the database
$sql_roles = "SELECT * FROM roles";
$result_roles = mysqli_query($conn, $sql_roles);

// Create an array of roles to use later for displaying role names
$roles = array();
while ($row_roles = mysqli_fetch_assoc($result_roles)) {
    $roles[$row_roles['id']] = $row_roles['name'];
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">

<!-- JavaScript (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<h2>Users</h2>
<button><a href="ass_role.php">Assign Role</a> </button>
<button><a href="../manage_role/roles.php">Mange permissions</a> </button>
<button><a href="../manage_permission/permissions.php">Manage Roles</a> </button>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <?php
                    // Fetch the user's role from the database
                    $sql_user_role = "SELECT role_id FROM user_roles WHERE user_id = " . $row['id'];
                    $result_user_role = mysqli_query($conn, $sql_user_role);
                    $row_user_role = mysqli_fetch_assoc($result_user_role);
                    
                    if(isset($row_user_role['role_id'])) {
                        echo $roles[$row_user_role['role_id']];
                    } else {
                        // handle the case where $row_user_role['role_id'] is null or undefined
                    }
                  
                ?>
            </td>
            <td>
                <?php if(isset($row_user_role['role_id'])): ?>
                <a href="revoke_role.php?user_id=<?php echo $row['id']; ?>&role_id=<?php echo $row_user_role['role_id']; ?>">Revoke Role</a>
                <?php endif; ?>
                <a href="edit_assign_role.php?user_id=<?php echo $row['id']; ?>&role_id=<?php echo $row_user_role['role_id']; ?>">Edit Role</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

