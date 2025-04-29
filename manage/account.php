<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col" style="background: linear-gradient(to right, #dfe9f3 0%, #ffffff 100%);">

    <!-- Navbar -->
    <nav class="bg-green-600 text-white px-4 py-3 shadow-md flex justify-between items-center">
        <div class="text-xl font-bold">Vroom Automobiles</div>
        <div class="space-x-4 text-sm">
            <a href="employees.php" class="hover:underline">Employees</a>
            <a href="automobiles.php" class="hover:underline">Automobiles</a>
            <a href="sales.php" class="hover:underline">Sales</a>
            <a href="account.php" class="hover:underline">Account</a>
            <a href="../php/logout.php" class="text-red-200 hover:text-white">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex justify-center mt-10 px-4">
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border border-gray-200">

            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Account Information</h2>

            <!-- Account Info -->
            <div class="mb-8 text-gray-700 space-y-2">
                <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            </div>

            <!-- Change Password Form -->
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Change Password</h3>
            <form action="../php/update_password.php" method="POST" class="space-y-5">
                <input type="password" name="current_password" placeholder="Current Password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="password" name="new_password" placeholder="New Password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                        class="w-full py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition duration-200 font-semibold">
                    Update Password
                </button>
            </form>

            <!-- Back to Dashboard Link -->
            <a href="../dashboard.php" class="block mt-8 text-center text-blue-500 hover:text-blue-600 font-semibold">⬅ Back to Dashboard</a>

        </div>
    </div>

</body>
</html>
