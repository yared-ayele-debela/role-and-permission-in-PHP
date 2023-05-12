<?php
require_once('../dbconnection.php');
// Start the session (if not already started)
session_start();

// Check if the user is already logged in, redirect to dashboard if true
if (isset($_SESSION['user_id'])) {
  header('Location: dashboard.php');
  exit();
}


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted username and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
  
    if(mysqli_num_rows($result) == 0) {
      echo "Error: User not found";
      exit;
    }
    // Verify password
    $row = mysqli_fetch_assoc($result);
    if(!password_verify($password, $row['password'])) {
      echo "Error: Incorrect password";
      exit;
    }

    if(password_verify($password, $row['password'])) {
      $_SESSION['user_id'] = $row['id'];  
      $_SESSION['email']=$_POST['email'];   
      // Redirect to the dashboard
      header('Location: dashboard.php');
      exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <li>
    <p>email:admin@gmail.com</p>
    <p>password:11223344</p>
  </li>
  <form method="POST" action="">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>
