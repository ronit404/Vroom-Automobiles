<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($current, $user['password'])) {
        $update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $update->execute([$new, $_SESSION['user_id']]);
        header("Location: ../manage/account.php?success=1");
    } else {
        header("Location: ../manage/account.php?error=1");
    }
    exit;
}
?>
