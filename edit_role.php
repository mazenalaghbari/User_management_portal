<?php
// Include database connection file
include_once 'db_connection.php';

// Fetch role data based on ID
$role_id = $_GET['id'];
$sql = "SELECT * FROM roles WHERE id = $role_id";
$result = mysqli_query($conn, $sql);
$role = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Update role data in the database
    $sqlUpdate = "UPDATE roles SET name = '$name', description = '$description' WHERE id = $role_id";
    if (mysqli_query($conn, $sqlUpdate)) {
        header("Location: roles.php"); // Redirect to role list after successful update
        exit();
    } else {
        echo "Error: " . $sqlUpdate . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Role</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Edit Role</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $role_id; ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $role['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description"
                            value="<?php echo $role['description']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </form>
            </div>
        </div>
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