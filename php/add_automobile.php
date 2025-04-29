<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = trim($_POST['model']);
    $brand = trim($_POST['brand']);
    $price = floatval($_POST['price']);

    $stmt = $conn->prepare("INSERT INTO automobiles (model, brand, price) VALUES (?, ?, ?)");
    $stmt->execute([$model, $brand, $price]);

    header("Location: ../manage/automobiles.php");
    exit;
}
?>
