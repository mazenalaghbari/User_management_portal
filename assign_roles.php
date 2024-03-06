<?php
// Include database connection file
include_once 'db_connection.php';

// Fetch users and roles from the database
$sqlUsers = "SELECT * FROM users";
$resultUsers = mysqli_query($conn, $sqlUsers);

$sqlRoles = "SELECT * FROM roles";
$resultRoles = mysqli_query($conn, $sqlRoles);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID and roles from the form submission
    $userId = $_POST['user_id'];
    $selectedRoles = isset($_POST['roles']) ? $_POST['roles'] : [];

    // Fetch existing roles for the user
    $sqlExistingRoles = "SELECT role_id FROM user_roles WHERE user_id = $userId";
    $resultExistingRoles = mysqli_query($conn, $sqlExistingRoles);
    $existingRoles = [];
    while ($row = mysqli_fetch_assoc($resultExistingRoles)) {
        $existingRoles[] = $row['role_id'];
    }

    // Determine new roles to add
    $newRoles = array_diff($selectedRoles, $existingRoles);

    // Insert new roles for the user
    foreach ($newRoles as $roleId) {
        $sqlInsertRole = "INSERT INTO user_roles (user_id, role_id) VALUES ($userId, $roleId)";
        mysqli_query($conn, $sqlInsertRole);
    }

    header("Location: user_roles.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Assign Roles to Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Assign Roles to Users</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="user">Select User:</label>
                <select class="form-control" name="user_id" id="user">
                    <?php while ($user = mysqli_fetch_assoc($resultUsers)): ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Select Roles:</label><br>
                <?php while ($role = mysqli_fetch_assoc($resultRoles)): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="<?php echo $role['id']; ?>"
                        id="role_<?php echo $role['id']; ?>">
                    <label class="form-check-label"
                        for="role_<?php echo $role['id']; ?>"><?php echo $role['name']; ?></label>
                </div>
                <?php endwhile; ?>
            </div>
            <button type="submit" class="btn btn-primary">Assign Roles</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery (optional, if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>