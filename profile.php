<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];

    // Update user profile
    $sql = "UPDATE users SET name = ?, email = ?, city = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $city, $user_id]);

    echo "Profile updated!";
}
?>

<form method="POST">
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="Name" required>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required>
    <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>" placeholder="City" required>
    <button type="submit">Update Profile</button>
</form>
