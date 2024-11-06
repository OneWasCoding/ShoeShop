<?php
session_start();
include 'includes/db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch products uploaded by the admin
$query = "SELECT * FROM products WHERE uploaded_by = 'admin'";
$products = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>All Products</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">Profile</a>
        </nav>
    </header>
    <div class="product-list">
        <?php if ($products->num_rows > 0): ?>
            <?php while ($row = $products->fetch_assoc()): ?>
                <div class="product">
                    <h2><?php echo $row['name']; ?></h2>
                    <p><?php echo $row['description']; ?></p>
                    <p>Price: $<?php echo $row['price']; ?></p>
                    <img src="images/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
                    <a href="cart.php?action=add&id=<?php echo $row['id']; ?>">Add to Cart</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
    <footer>
        <p>© 2024 EM Quality Shoes</p>
    </footer>
</body>
</html>
