<?php 
require_once('../dbconnection.php');
  session_start();
  $_SESSION['user_id'] = $row['id'];
  $user_id=$_SESSION['user_id'];
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
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          
        </a>
      </li>
      <!-- <?php if (in_array('admin', $user_roles)&& in_array('view', $user_permissions)): ?>
       ?>
      <li>
        <a href="../manage_role/roles.php" class="nav-link link-dark">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
         Roles
        </a>
      </li>
      <?php
           endif
        ?> -->
        <?php echo "hello ".$_SESSION['user_id']."there"; ?>
      <li>
        <a href="../manage_permission/permissions.php" class="nav-link link-dark">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Permissions
        </a>
      </li>
      <li>
        <a href="ass_role.php" class="nav-link link-dark">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Assing Role
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-dark">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Customers
        </a>
      </li>
    </ul>
    <hr>
    
  </div>
    </body>
</html>