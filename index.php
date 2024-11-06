<?php
session_start();
include 'includes/db.php'; // Include database connection
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome to EM Quality Shoes</h1>
    <h2>Your Shopping Options</h2>
    <a href="products.php">Browse Products</a>
    <h2>Your Profile</h2>
    <a href="profile.php">Manage Profile</a>
    <h2>Your Reviews</h2>
    <a href="user_reviews.php">View Your Reviews</a>
</body>
</html>
