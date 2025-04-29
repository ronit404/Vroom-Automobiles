<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);

    $stmt = $conn->prepare("INSERT INTO employees (name, position) VALUES (?, ?)");
    $stmt->execute([$name, $position]);

    header("Location: ../manage/employees.php");
    exit;
}
?>
