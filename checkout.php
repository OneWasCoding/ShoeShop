<?php
session_start();
include 'includes/db.php'; // Include database connection

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $total = 0;

    // Calculate total price
    foreach ($_SESSION['cart'] as $product_id) {
        $product = $conn->query("SELECT price FROM products WHERE id = $product_id")->fetch_assoc();
        $total += $product['price'];
    }

    // Insert order into database
    $conn->query("INSERT INTO orders (user_id, total) VALUES ($user_id, $total)");
    $order_id = $conn->insert_id;

    // Insert order items
    foreach ($_SESSION['cart'] as $product_id) {
        $product = $conn->query("SELECT price FROM products WHERE id = $product_id")->fetch_assoc();
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, 1, {$product['price']})");
    }

    // Clear cart
    unset($_SESSION['cart']);
    echo "Order placed successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Checkout</h1>
    <form method="POST">
        <h2>Order Summary</h2>
        <ul>
            <?php foreach ($_SESSION['cart'] as $product_id): ?>
                <?php $product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc(); ?>
                <li><?php echo $product['name']; ?> - $<?php echo $product['price']; ?></li>
            <?php endforeach; ?>
        </ul>
        <input type="submit" value="Place Order">
    </form>
</body>
</html>
