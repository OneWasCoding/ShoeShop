<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php"); // Redirect if not admin
    exit();
}

// Handle product upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];

    // Move uploaded file to the images/products directory
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/products/" . $image);

    // Insert new product into the database
    $conn->query("INSERT INTO products (name, description, price, stock, image) VALUES ('$name', '$description', '$price', '$stock', '$image')");
    echo "Product added successfully!";
}

// Fetch all products for display
$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - EM Quality Shoes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Products</h1>

    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" required placeholder="Product Name">
        <textarea name="description" required placeholder="Product Description"></textarea>
        <input type="number" name="price" required placeholder="Price">
        <input type="number" name="stock" required placeholder="Stock Quantity">
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" name="add_product" value="Add Product">
    </form>

    <h2>Existing Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($product = $products->fetch_assoc()): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td>$<?php echo $product['price']; ?></td>
                <td><?php echo $product['stock']; ?></td>
                <td><img src="../images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="50"></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
                    <a href="delete_product.php?id=<?php echo $product['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
