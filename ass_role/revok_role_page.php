<h2>Revoke Role from User</h2>

<form method="post" action="revoke_role.php">
  <label for="user_id">User:</label>
  <select name="user_id" id="user_id" required>
    <?php
     require_once('../dbconnection.php');

      // Fetch all users from the database
      $sql_users = "SELECT * FROM users";
      $result_users = mysqli_query($conn, $sql_users);

      while($row_users = mysqli_fetch_assoc($result_users)) {
        echo '<option value="' . $row_users['id'] . '">' . $row_users['username'] . '</option>';
      }
    ?>
  </select>

  <label for="role_id">Role:</label>
  <select name="role_id" id="role_id" required>
    <?php
     require_once('../dbconnection.php');

      // Fetch all roles from the database
      $sql_roles = "SELECT * FROM roles";
      $result_roles = mysqli_query($conn, $sql_roles);

      while($row_roles = mysqli_fetch_assoc($result_roles)) {
        echo '<option value="' . $row_roles['id'] . '">' . $row_roles['name'] . '</option>';
      }
    ?>
  </select>

  <input type="submit" value="Revoke Role">
</form>
