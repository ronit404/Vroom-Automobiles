<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

// Check if the sale ID is passed in the URL
if (isset($_GET['id'])) {
    $saleId = $_GET['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM sales WHERE id = ?");
    $stmt->execute([$saleId]);

    // Redirect back to the Manage Sales page after deletion
    header("Location: ../manage/sales.php");
    exit;
} else {
    // If no ID is provided, redirect to the Manage Sales page
    header("Location: ../manage/sales.php");
    exit;
}
?>
