<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php"); // Redirect if not admin
    exit();
}

$product_id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Check if a new image is uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/products/" . $image);
        $conn->query("UPDATE products SET name='$name', description='$description', price='$price', stock='$stock', image='$image' WHERE id=$product_id");
    } else {
        $conn->query("UPDATE products SET name='$name', description='$description', price='$price', stock='$stock' WHERE id=$product_id");
    }
    header("Location: products.php"); // Redirect back to products page
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - EM Quality Shoes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
        <input type="file" name="image" accept="image/*">
        <input type="submit" value="Update Product">
    </form>
</body>
</html>
