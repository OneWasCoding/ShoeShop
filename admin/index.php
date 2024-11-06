<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php"); // Redirect if not admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - EM Quality Shoes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Manage Products</h2>
    <a href="products.php">View Products</a>
    <h2>Transaction History</h2>
    <a href="orders.php">View Orders</a>
    <h2>User Management</h2>
    <a href="users.php">Manage Users</a>
    <h2>Reviews Management</h2>
    <a href="reviews.php">Moderate Reviews</a>
</body>
</html>
