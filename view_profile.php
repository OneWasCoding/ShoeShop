<?php
session_start();
include 'includes/db.php'; // Include database connection

// Check if the user is logged in and fetch user information if they are
$user_id = $_SESSION['user_id'] ?? null;
$user = null;

if ($user_id) {
    $user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Your Profile</h1>
    <?php if ($user): ?>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        
        <!-- Display profile picture if it exists -->
        <?php if (!empty($user['profile_picture'])): ?>
            <img src="uploads/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" style="width:150px;height:auto;">
        <?php else: ?>
            <p>No profile picture uploaded.</p>
        <?php endif; ?>

        <a href="update_profile.php">Edit Profile</a> <!-- Link to the profile editing page -->
    <?php else: ?>
        <p>You are not logged in. Please log in to view your profile.</p>
    <?php endif; ?>
</body>
</html>
