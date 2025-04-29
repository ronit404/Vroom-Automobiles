<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = trim($_POST['customer_name']);
    $automobile_id = intval($_POST['automobile_id']);
    $date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO sales (customer_name, automobile_id, date) VALUES (?, ?, ?)");
    $stmt->execute([$customer_name, $automobile_id, $date]);

    header("Location: ../manage/sales.php");
    exit;
}
?>
