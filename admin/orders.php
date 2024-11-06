<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
}

// Fetch all orders
$orders = $conn->query("SELECT orders.id, users.email, orders.total, orders.status, orders.created_at FROM orders JOIN users ON orders.user_id = users.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders - EM Quality Shoes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Orders</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>User Email</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($order = $orders->fetch_assoc()): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['email']; ?></td>
                <td>$<?php echo $order['total']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td>
                    <a href="order_details.php?id=<?php echo $order['id']; ?>">View Details</a>
                    <a href="update_order.php?id=<?php echo $order['id']; ?>">Update Status</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
