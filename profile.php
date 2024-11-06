<?php
session_start();
include 'includes/db.php'; // Include database connection
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $profile_picture = $_FILES['profile_picture']['name'];
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], "uploads/" . $profile_picture);

    $conn->query("UPDATE users SET email = '$email', profile_picture = '$profile_picture' WHERE id = $user_id");
    echo "Profile updated!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Your Profile</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <input type="file" name="profile_picture" accept="image/*">
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
