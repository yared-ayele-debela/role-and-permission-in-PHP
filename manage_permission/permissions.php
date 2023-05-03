<!DOCTYPE html>
<html>
<head>
	<title>Permissions</title>
</head>
<body>
	<h1>Permissions</h1>
	<a href="add_permission_page.php">Add Permission</a>
	<br><br>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Action</th>
		</tr>
		<?php
		
        require_once('../dbconnection.php');

		// Fetch all permissions from database
		$sql_permissions = "SELECT * FROM permissions";
		$result_permissions = mysqli_query($conn, $sql_permissions);

		// Loop through permissions and output table rows with edit and delete buttons
		while ($row_permission = mysqli_fetch_assoc($result_permissions)) {
		    echo "<tr>";
		    echo "<td>" . $row_permission['id'] . "</td>";
		    echo "<td>" . $row_permission['name'] . "</td>";
		    echo "<td>";
		    echo "<a href=\"edit_permission.php?id=" . $row_permission['id'] . "\">Edit</a> | ";
		    echo "<a href=\"delete_permission.php?id=" . $row_permission['id'] . "\" onclick=\"return confirm('Are you sure you want to delete this permission?');\">Delete</a>";
		    echo "</td>";
		    echo "</tr>";
		}

		// Close database connection
		mysqli_close($conn);
		?>
	</table>
</body>
</html>
