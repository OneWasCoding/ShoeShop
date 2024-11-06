<?php
require '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $contacts = $_POST['contacts'];
    $sex = $_POST['sex'];

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', age='$age', address='$address', contacts='$contacts', sex='$sex' WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Check if the profile is incomplete
if (empty($user['first_name']) || empty($user['last_name']) || empty($user['age']) || empty($user['address']) || empty($user['contacts']) || empty($user['sex'])) {
    echo "Please complete your profile before viewing.<br>";
    echo "<a href='edit_profile.php'>Complete Profile</a>";
    exit;
}
?>
<form method="post">
    First Name: <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"><br>
    Last Name: <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"><br>
    Age: <input type="number" name="age" value="<?php echo $user['age']; ?>"><br>
    Address: <textarea name="address"><?php echo $user['address']; ?></textarea><br>
    Contacts: <input type="text" name="contacts" value="<?php echo $user['contacts']; ?>"><br>
    Sex: 
    <select name="sex">
        <option value="male" <?php if ($user['sex'] == 'male') echo 'selected'; ?>>Male</option>
        <option value="female" <?php if ($user['sex'] == 'female') echo 'selected'; ?>>Female</option>
        <option value="other" <?php if ($user['sex'] == 'other') echo 'selected'; ?>>Other</option>
    </select><br>
    <input type="submit" value="Update Profile">
</form>
