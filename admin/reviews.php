<?php
// Start the session and include database connection
session_start();
include '../includes/db.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit();
}

// Fetch reviews from the database
$query = "SELECT reviews.review_id, reviews.rating, reviews.review_text, reviews.created_at, 
          users.username, products.product_name 
          FROM reviews 
          JOIN users ON reviews.user_id = users.user_id 
          JOIN products ON reviews.product_id = products.product_id 
          ORDER BY reviews.created_at DESC";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Reviews</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>User Reviews</h1>
        
        <table border="1">
            <tr>
                <th>Review ID</th>
                <th>User</th>
                <th>Product</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Date</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['review_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['product_name']}</td>
                            <td>{$row['rating']} / 5</td>
                            <td>{$row['review_text']}</td>
                            <td>{$row['created_at']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No reviews available</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
<?php
// Start the session and include database connection
session_start();
include '../includes/db.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit();
}

// Fetch reviews from the database
$query = "SELECT reviews.review_id, reviews.rating, reviews.review_text, reviews.created_at, 
          users.username, products.product_name 
          FROM reviews 
          JOIN users ON reviews.user_id = users.user_id 
          JOIN products ON reviews.product_id = products.product_id 
          ORDER BY reviews.created_at DESC";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Reviews</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>User Reviews</h1>
        
        <table border="1">
            <tr>
                <th>Review ID</th>
                <th>User</th>
                <th>Product</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Date</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['review_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['product_name']}</td>
                            <td>{$row['rating']} / 5</td>
                            <td>{$row['review_text']}</td>
                            <td>{$row['created_at']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No reviews available</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
