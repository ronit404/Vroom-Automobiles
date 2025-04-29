<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

// Get the employee ID from the URL
if (isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->execute([$employeeId]);

    // Redirect back to the Manage Employees page after deletion
    header("Location: ../manage/employees.php");
    exit;
} else {
    // If no ID is provided, redirect to the Manage Employees page
    header("Location: ../manage/employees.php");
    exit;
}
?>
