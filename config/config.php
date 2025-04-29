<?php
// config/config.php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');    // Default XAMPP username
define('DB_PASSWORD', '');        // Leave blank (default in XAMPP)
define('DB_DATABASE', 'showroom_db');

try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connected successfully"; // You can uncomment this for testing
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
