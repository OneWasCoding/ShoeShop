<?php
include 'includes/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $profile_picture = $_FILES['profile_picture']['name'];

    // Move uploaded file to the uploads directory
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], "uploads/" . $profile_picture);

    // Insert user into the database
    $conn->query("INSERT INTO users (email, password, profile_picture) VALUES ('$email', '$password', '$profile_picture')");
    echo "Registration successful!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Create an Account</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="file" name="profile_picture" accept="image/*">
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Click here to login</a>.</p>
</body>
</html>
