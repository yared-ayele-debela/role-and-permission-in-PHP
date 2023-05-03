<h2>User Roles and Permissions</h2>

<!-- Table of roles and permissions -->
<table>
  <thead>
    <tr>
      <th>Role</th>
      <th>Permissions</th>
      <th>Edit</th>
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

        // Display edit and delete buttons
        echo '<td><a href="edit_role.php?id=' . $row['id'] . '">Edit</a></td>';
        echo '<td><a href="delete_role.php?id=' . $row['id'] . '">Delete</a></td>';

        echo '</tr>';
      }
    ?>
  </tbody>
</table>

<!-- Form to add a new role -->
<h3>Add Role</h3>
<form method="post" action="add_role.php">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" required>

  <h4>Permissions</h4>
  <?php
    // Fetch all permissions from the database
    $sql = "SELECT * FROM permissions";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
      // Display checkbox for each permission
      echo '<label>';
      echo '<input type="checkbox" name="permissions[]" value="' . $row['id'] . '"> ';
      echo $row['name'];
      echo '</label>';
    }
  ?>

  <br>
  <input type="submit" value="Add Role">
</form>
