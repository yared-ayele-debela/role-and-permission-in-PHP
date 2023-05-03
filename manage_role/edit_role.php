<?php

require_once('../dbconnection.php');
// Get role ID from URL parameter
$role_id = $_GET['id'];

// Fetch role data from database
$sql_role = "SELECT * FROM roles WHERE id = " . $role_id;
$result_role = mysqli_query($conn, $sql_role);
$row_role = mysqli_fetch_assoc($result_role);

// Fetch all permissions from the database
$sql_permissions = "SELECT * FROM permissions";
$result_permissions = mysqli_query($conn, $sql_permissions);

// Fetch permissions for this role
$sql_role_permissions = "SELECT * FROM role_permissions WHERE role_id = " . $role_id;
$result_role_permissions = mysqli_query($conn, $sql_role_permissions);
$role_permissions = array();
while($row_role_permissions = mysqli_fetch_assoc($result_role_permissions)) {
  $role_permissions[] = $row_role_permissions['permission_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Role</title>
</head>
<body>

  <h2>Edit Role: <?php echo $row_role['name']; ?></h2>

  <!-- Form to edit role -->
  <form method="post" action="update_role.php">
    <input type="hidden" name="id" value="<?php echo $role_id; ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $row_role['name']; ?>" required>

    <h4>Permissions</h4>
    <?php
      while($row_permissions = mysqli_fetch_assoc($result_permissions)) {
        // Display checkbox for each permission
        $checked = '';
        if(in_array($row_permissions['id'], $role_permissions)) {
          $checked = 'checked';
        }

        echo '<label>';
        echo '<input type="checkbox" name="permissions[]" value="' . $row_permissions['id'] . '" ' . $checked . '> ';
        echo $row_permissions['name'];
        echo '</label>';
      }
    ?>

    <br>
    <input type="submit" value="Update Role">
  </form>

</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
