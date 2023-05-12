<?php
// Include database connection
require_once('../dbconnection.php');

// Fetch user's roles and permissions from the database
session_start(); 

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login/loginpage.php');
    exit();
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT r.name AS role, p.name AS permission
        FROM user_roles ur
        INNER JOIN roles r ON ur.role_id = r.id
        INNER JOIN role_permissions rp ON r.id = rp.role_id
        INNER JOIN permissions p ON rp.permission_id = p.id
        WHERE ur.user_id = $user_id";

$result = mysqli_query($conn, $sql);

// Create an array of the user's roles and permissions
$user_roles = array();
$user_permissions = array();

while ($row = mysqli_fetch_assoc($result)) {
    $user_roles[] = $row['role'];
    $user_permissions[] = $row['permission'];
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

<h2>User Roles and Permissions</h2>

<!-- Table of roles and permissions -->
<table class="table table-striped">
  <thead>
    <tr>
      <th>Role</th>
      <th>Permissions</th>
      <th>Edit Permission</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
        require_once('../dbconnection.php');

      // Fetch all roles from the database
      $sql = "SELECT * FROM roles";
      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($result)) {
        // Display each role and its permissions in a table row
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';

        // Fetch permissions for this role
        $sql_permissions = "SELECT * FROM role_permissions WHERE role_id = " . $row['id'];
        $result_permissions = mysqli_query($conn, $sql_permissions);

        // Display list of permissions in a comma-separated string
        $permission_names = array();
        while($row_permissions = mysqli_fetch_assoc($result_permissions)) {
          $sql_permission = "SELECT * FROM permissions WHERE id = " . $row_permissions['permission_id'];
          $result_permission = mysqli_query($conn, $sql_permission);
          $row_permission = mysqli_fetch_assoc($result_permission);

          $permission_names[] = $row_permission['name'];
        }
        echo '<td>' . implode(', ', $permission_names) . '</td>';
        //for check permission and roles of users
        if(in_array('admin',$user_roles)&& in_array('edit',$user_permissions)){
        // Display edit and delete buttons
        echo '<td><a class="btn btn-warning" href="edit_role.php?id=' . $row['id'] . '">Edit</a></td>';
        echo '<td><a class="btn btn-danger" href="delete_role.php?id=' . $row['id'] . '">Delete</a></td>';

        echo '</tr>';
        }else{
          echo 'no permissions';
        }
      }
    ?>
  </tbody>
</table>

<!-- Form to add a new role -->
<h3>Add Role</h3>
<form method="post" action="add_role.php">
  <label class="form-lable" for="name">Name:</label>
  <input class="form-control col-5" type="text" name="name" id="name" required>

  <h4>Permissions</h4>
  <?php
    // Fetch all permissions from the database
    $sql = "SELECT * FROM permissions";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
      // Display checkbox for each permission
      echo '<label>';
      echo '<input class="form-check-input"  type="checkbox" name="permissions[]" value="' . $row['id'] . '"> ';
      echo $row['name'];
      echo '</label> <br>';
    }
  ?>

  <br>
  <br>
  <input type="submit" class="btn btn-primary" value="Add Role">
</form>
</body>
</html>


