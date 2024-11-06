<?php
session_start();
include 'includes/db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch reviews made by the logged-in user
$query = "SELECT reviews.id AS review_id, reviews.rating, reviews.review_text, reviews.created_at, 
                 products.name AS product_name 
          FROM reviews 
          JOIN products ON reviews.product_id = products.id 
          WHERE reviews.user_id = ? 
          ORDER BY reviews.created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$reviews = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Reviews - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Your Reviews</h1>
    <table>
        <tr>
            <th>Review ID</th>
            <th>Product Name</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Date</th>
        </tr>
        <?php if ($reviews->num_rows > 0): ?>
            <?php while ($review = $reviews->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($review['review_id']); ?></td>
                    <td><?php echo htmlspecialchars($review['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($review['rating']); ?> / 5</td>
                    <td><?php echo htmlspecialchars($review['review_text']); ?></td>
                    <td><?php echo htmlspecialchars($review['created_at']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">You have not reviewed any products yet.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
