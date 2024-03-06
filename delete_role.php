<?php
// Include database connection file
include_once 'db_connection.php';

// Check if role ID is provided
if (isset($_GET['id'])) {
    $role_id = $_GET['id'];

    // Delete role from the database
    $sqlDelete = "DELETE FROM roles WHERE id = $role_id";
    if (mysqli_query($conn, $sqlDelete)) {
        header("Location: roles.php"); // Redirect to role list after successful deletion
        exit();
    } else {
        echo "Error: " . $sqlDelete . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Role ID not provided.";
}
?>