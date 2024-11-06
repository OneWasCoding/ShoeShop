<?php
session_start();
include 'includes/db.php'; // Include database connection

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $product_id = $_GET['id'];
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
}

// Fetch products in the cart
$cart_items = [];
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', $_SESSION['cart']);
    $cart_items = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <div class="cart-list">
        <?php if ($cart_items->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php while ($item = $cart_items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo $item['price']; ?></td>
                        <td><a href="cart.php?action=remove&id=<?php echo $item['id']; ?>">Remove</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <a href="checkout.php">Proceed to Checkout</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
