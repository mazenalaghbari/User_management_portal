<?php
// Include database connection file
include_once 'db_connection.php';

// Check if user ID and role ID are provided
if (isset($_GET['user_id']) && isset($_GET['role_id'])) {
    $userId = $_GET['user_id'];
    $roleId = $_GET['role_id'];

    // Delete user role from the database
    $sqlDeleteUserRole = "DELETE FROM user_roles WHERE user_id = $userId AND role_id = $roleId";
    if (mysqli_query($conn, $sqlDeleteUserRole)) {
        header("Location: user_roles.php"); // Redirect to user roles list after successful deletion
        exit();
    } else {
        echo "Error: " . $sqlDeleteUserRole . "<br>" . mysqli_error($conn);
    }
} else {
    echo "User ID or Role ID not provided.";
}
?>