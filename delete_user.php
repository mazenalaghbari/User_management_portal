<?php
// Include database connection file
include_once 'db_connection.php';

// Check if user ID is provided
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete user from the database
    $sqlDelete = "DELETE FROM users WHERE id = $user_id";
    if (mysqli_query($conn, $sqlDelete)) {
        header("Location: users.php"); // Redirect to user list after successful deletion
        exit();
    } else {
        echo "Error: " . $sqlDelete . "<br>" . mysqli_error($conn);
    }
} else {
    echo "User ID not provided.";
}
?>