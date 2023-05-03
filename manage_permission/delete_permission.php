


<!DOCTYPE html>
<html>
<head>
	<title>Delete Permission</title>
</head>
<body>
	<h1>Delete Permission</h1>
	<?php
	// Check if permission ID is set and is a number
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	    $permission_id = $_GET['id'];

	    require_once('../dbconnection.php');

	    // Fetch permission name from database
	    $sql_permission = "SELECT name FROM permissions WHERE id = $permission_id";
	    $result_permission = mysqli_query($conn, $sql_permission);

	    if (mysqli_num_rows($result_permission) == 1) {
	        $row_permission = mysqli_fetch_assoc($result_permission);
	        $permission_name = $row_permission['name'];

	        // If form submitted, delete permission from database and redirect to permissions page
	        if (isset($_POST['submit'])) {
	            $sql_delete = "DELETE FROM permissions WHERE id = $permission_id";
	            if (mysqli_query($conn, $sql_delete)) {
	                mysqli_close($conn);
	                header("Location: permissions.php");
	                exit;
	            } else {
	                echo "Error deleting permission: " . mysqli_error($conn);
	            }
	        }

	        // Output permission name and confirmation message
	        echo "<p>Are you sure you want to delete the permission <strong>" . $permission_name . "</strong>?</p>";
	        echo "<form method=\"post\">";
	        echo "<input type=\"submit\" name=\"submit\" value=\"Delete\">";
	        echo "<a href=\"permissions.php\">Cancel</a>";
	        echo "</form>";
	    } else {
	        echo "Permission not found.";
	    }

	    // Close database connection
	    mysqli_close($conn);
	} else {
	    echo "Invalid permission ID.";
	}
	?>
</body>
</html>
