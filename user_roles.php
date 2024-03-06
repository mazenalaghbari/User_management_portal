<?php
// Include database connection file
include_once 'db_connection.php';

// Check if a user role deletion request is sent
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id']) && isset($_GET['role_id'])) {
    $user_id = $_GET['user_id'];
    $role_id = $_GET['role_id'];

    // Delete the user role from the database
    $sql = "DELETE FROM user_roles WHERE user_id = $user_id AND role_id = $role_id";
    if(mysqli_query($conn, $sql)) {
        echo "User role deleted successfully.";
    } else {
        echo "Error deleting user role: " . mysqli_error($conn);
    }
}

// Fetch users and their roles from the database
$sql = "SELECT u.id AS user_id, u.username, r.id AS role_id, r.name AS role_name
        FROM users u 
        LEFT JOIN user_roles ur ON u.id = ur.user_id 
        LEFT JOIN roles r ON ur.role_id = r.id";
$result = mysqli_query($conn, $sql);
$userRoles = array();
while ($row = mysqli_fetch_assoc($result)) {
    $userRoles[$row['user_id']][] = array('role_id' => $row['role_id'], 'role_name' => $row['role_name'], 'username' => $row['username']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Roles Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container mt-5">
        <h1>User Roles List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userRoles as $userId => $roles): ?>
                <tr>
                    <td><?php echo $userId; ?></td>
                    <td><?php echo isset($roles[0]['username']) ? $roles[0]['username'] : ''; ?></td>
                    <td>
                        <?php foreach ($roles as $role): ?>
                        <span class="badge badge-secondary"><?php echo $role['role_name']; ?></span><br>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($roles as $role): ?>
                        <a href="user_roles.php?action=delete&user_id=<?php echo $userId; ?>&role_id=<?php echo $role['role_id']; ?>"
                            class="btn btn-danger btn-sm">Delete</a>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="assign_roles.php" class="btn btn-primary">Assign Roles</a>
    </div>

    <!-- Bootstrap JS and jQuery (optional, if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html