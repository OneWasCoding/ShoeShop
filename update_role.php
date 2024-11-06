<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];

    // Update user role in the database
    $conn->query("UPDATE users SET role = '$role' WHERE id = $user_id");
    header("Location: users.php"); // Redirect back to user management page
}
?>
