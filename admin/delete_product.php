<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php"); // Redirect if not admin
    exit();
}

$product_id = $_GET['id'];
$conn->query("DELETE FROM products WHERE id = $product_id");
header("Location: products.php"); // Redirect back to products page
?>
