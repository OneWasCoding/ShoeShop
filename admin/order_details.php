<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
}

$order_id = $_GET['id'];
$order = $conn->query("SELECT * FROM orders WHERE id = $order_id")->fetch_assoc();
$items = $conn->query("SELECT order_items.*, products.name FROM order_items JOIN products ON order_items.product_id = products.id WHERE order_id = $order_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details - EM Quality Shoes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Order Details</h1>
    <p>Order ID: <?php echo $order['id']; ?></p>
    <p>User ID: <?php echo $order['user_id']; ?></p>
    <p>Total: $<?php echo $order['total']; ?></p>
    <p>Status: <?php echo $order['status']; ?></p>
    <h2>Items</h2>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php while ($item = $items->fetch_assoc()): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>$<?php echo $item['price']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
