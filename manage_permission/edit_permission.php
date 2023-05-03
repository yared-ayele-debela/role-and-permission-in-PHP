<!DOCTYPE html>
<html>
<head>
	<title>Edit Permission</title>
</head>
<body>
	<h1>Edit Permission</h1>
	<?php

    require_once('../dbconnection.php');

	// Get permission ID from GET data
	$permission_id = $_GET['id'];

	// Get permission data from database
	$sql_permission = "SELECT * FROM permissions WHERE id = $permission_id";
	$result_permission = mysqli_query($conn, $sql_permission);

	// Check if permission exists
	if (mysqli_num_rows($result_permission) == 1) {
	    $row_permission = mysqli_fetch_assoc($result_permission);
	} else {
	    echo "Permission not found";
	    exit();
	}

	// Close database connection
	mysqli_close($conn);
	?>
	<form method="POST" action="update_permission.php">
		<input type="hidden" name="id" value="<?php echo $permission_id; ?>">
		<label for="name">Permission Name:</label>
		<input type="text" name="name" id="name" value="<?php echo $row_permission['name']; ?>" required>
		<br><br>
		<input type="submit" value="Save Changes">
	</form>
</body>
</html>
