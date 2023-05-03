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
    <h2>Assign Role to User</h2>
            <form method="post" action="assign_role.php">
            <label for="user">User:</label>
            <select name="user" id="user" required>
                <?php
                require_once('../dbconnection.php');

                // Fetch all users from the database
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                ?>
            </select>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <?php
                require_once('../dbconnection.php');

                // Fetch all roles from the database
                $sql = "SELECT * FROM roles";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                ?>
            </select>

            <br>
            <input type="submit" value="Assign Role">
            </form>

    </body>
</html>