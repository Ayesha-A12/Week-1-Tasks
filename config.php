<?php
// MySQL connection
$host = 'localhost';  // or your host if different
$db   = 'user_auth';  // database name
$user = 'root';       // MySQL username
$pass = '';           // MySQL password (leave empty if no password)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
