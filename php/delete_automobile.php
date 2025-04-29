<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

// Check if the automobile ID is passed in the URL
if (isset($_GET['id'])) {
    $autoId = $_GET['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM automobiles WHERE id = ?");
    $stmt->execute([$autoId]);

    // Redirect back to the Manage Automobiles page after deletion
    header("Location: ../manage/automobiles.php");
    exit;
} else {
    // If no ID is provided, redirect to the Manage Automobiles page
    header("Location: ../manage/automobiles.php");
    exit;
}
?>
