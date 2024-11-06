<?php
include 'includes/db.php';
session_start();

$product_id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p><?php echo $product['description']; ?></p>
    <p>Price: $<?php echo $product['price']; ?></p>

    <h2>Customer Reviews</h2>
    <?php
    // Fetch active reviews for the product
    $review_query = $conn->query("SELECT rating, review_text, created_at FROM reviews WHERE product_id = $product_id AND status = 'active'");
    if ($review_query->num_rows > 0) {
        while ($review = $review_query->fetch_assoc()) {
            echo "<div class='review'>";
            echo "<p>Rating: {$review['rating']} / 5</p>";
            echo "<p>{$review['review_text']}</p>";
            echo "<p>Date: {$review['created_at']}</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews yet. Be the first to review!</p>";
    }
    ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <h3>Leave a Review</h3>
        <form method="POST" action="">
            <label for="rating">Rating:</label>
            <select name="rating" required>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Good</option>
                <option value="3">3 - Average</option>
                <option value="2">2 - Poor</option>
                <option value="1">1 - Terrible</option>
            </select>
            <br>
            <label for="comment">Your Review:</label>
            <textarea name="comment" required></textarea>
            <br>
            <button type="submit">Submit Review</button>
        </form>
    <?php else: ?>
        <p>Please <a href="login.php">login</a> to leave a review.</p>
    <?php endif; ?>

    <?php
    // Handle review submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
        $rating = $_POST['rating'];
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $user_id = $_SESSION['user_id'];
        $conn->query("INSERT INTO reviews (product_id, user_id, rating, review_text, status) VALUES ($product_id, $user_id, $rating, '$comment', 'active')");
        echo "<p>Review submitted successfully!</p>";
    }
    ?>
</body>
</html>
