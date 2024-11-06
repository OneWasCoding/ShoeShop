<?php
session_start();
include '../includes/db.php'; // Include database connection
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php"); // Redirect if not admin
    exit();
}

// Fetch users
$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management - EM Quality Shoes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>User Management</h1>
    <a href="create_user.php" class="button">Create New User</a> <!-- Button to create new user -->
    <table>
        <tr>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php while ($user = $users->fetch_assoc()): ?>
            <tr>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <form method="POST" action="update_role.php">
                        <select name="role">
                            <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="submit" value="Update Role">
                    </form>
                </td>
                <td>
                    <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
