<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
}

$order_id = $_GET['id'];
$order = $conn->query("SELECT * FROM orders WHERE id = $order_id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $conn->query("UPDATE orders SET status = '$status' WHERE id = $order_id");
    header("Location: orders.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Order Status - EM Quality Shoes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Update Order Status</h1>
    <form method="POST">
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="pending" <?php if ($order['status'] == 'pending') echo 'selected'; ?>>Pending</option>
            <option value="completed" <?php if ($order['status'] == 'completed') echo 'selected'; ?>>Completed</option>
            <option value="canceled" <?php if ($order['status'] == 'canceled') echo 'selected'; ?>>Canceled</option>
        </select>
        <input type="submit" value="Update Status">
    </form>
</body>
</html>
