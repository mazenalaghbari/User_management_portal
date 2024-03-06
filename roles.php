<?php
// Include database connection file
include_once 'db_connection.php';

// Fetch roles from the database
$sql = "SELECT * FROM roles";
$result = mysqli_query($conn, $sql);
$roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Role Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container mt-5">
        <h1>Role List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?php echo $role['id']; ?></td>
                    <td><?php echo $role['name']; ?></td>
                    <td><?php echo $role['description']; ?></td>
                    <td>
                        <a href="edit_role.php?id=<?php echo $role['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_role.php?id=<?php echo $role['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this role?');"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_role.php" class="btn btn-success">Add New Role</a>
    </div>

    <!-- Bootstrap JS and jQuery (optional, if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close connection
mysqli_close($conn);
?>