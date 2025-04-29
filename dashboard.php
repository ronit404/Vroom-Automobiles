<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-between">

    <!-- Header -->
    <header class="w-full bg-green-600 text-white text-center py-4 shadow-md">
        <h1 class="text-2xl font-bold">Vroom Automobiles</h1>
    </header>

    <!-- Full White Background Section Below Header -->
    <main class="flex-grow flex items-center justify-center w-full">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96 text-center mt-8 border border-gray-300">

            <h2 class="text-xl font-semibold text-gray-800 mb-6">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋
            </h2>

            <div class="space-y-4">
                <a href="manage/employees.php" class="block py-3 text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                    Manage Employees
                </a>
                <a href="manage/automobiles.php" class="block py-3 text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                    Manage Automobiles
                </a>
                <a href="manage/sales.php" class="block py-3 text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                    Manage Sales
                </a>
                <a href="manage/account.php" class="block py-3 text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                    Manage Account
                </a>
                <a href="php/logout.php" class="block py-3 text-center text-red-500 hover:text-red-600 border-t border-gray-300 mt-6">
                    Logout
                </a>
            </div>
        </div>
    </main>

</body>
</html>
