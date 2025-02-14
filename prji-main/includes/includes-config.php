<?php
$host = "localhost"; // Change if needed
$dbname = "gestion_clubs"; // Database name
$username = "root"; // Default user for XAMPP/WAMP
$password = ""; // Default is empty in XAMPP/WAMP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
