<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

$autos = $conn->query("SELECT * FROM automobiles")->fetchAll(PDO::FETCH_ASSOC);
$sales = $conn->query("SELECT s.id, a.brand, a.model, s.customer_name, s.date FROM sales s JOIN automobiles a ON s.automobile_id = a.id ORDER BY s.date DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sales</title>
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
        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md border border-gray-200">

            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Record a New Sale</h2>

            <!-- Form to Record a Sale -->
            <form action="../php/add_sale.php" method="POST" class="space-y-5">
                <input type="text" name="customer_name" placeholder="Customer Name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                
                <select name="automobile_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Select Automobile</option>
                    <?php foreach ($autos as $auto): ?>
                        <option value="<?= $auto['id'] ?>"><?= htmlspecialchars($auto['brand']) ?> <?= htmlspecialchars($auto['model']) ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit"
                        class="w-full py-3 text-white bg-green-500 rounded-xl hover:bg-green-600 transition duration-200 font-semibold">Record Sale</button>
            </form>

            <!-- Sales History -->
            <h3 class="text-2xl font-semibold text-gray-800 mt-8 mb-4">Sales History</h3>
            <ul class="space-y-3">
                <?php foreach ($sales as $sale): ?>
                    <li class="flex justify-between items-center bg-gray-100 p-3 rounded-lg shadow-sm hover:bg-gray-200 transition">
                        <span class="text-gray-800">
                            <?= htmlspecialchars($sale['date']) ?>: <?= htmlspecialchars($sale['brand']) ?> <?= htmlspecialchars($sale['model']) ?> sold to <?= htmlspecialchars($sale['customer_name']) ?>
                        </span>
                        <a href="../php/delete_sale.php?id=<?= $sale['id'] ?>" class="text-red-500 hover:text-red-600 font-semibold">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Back to Dashboard Button -->
            <a href="../dashboard.php" class="block mt-8 text-center text-blue-500 hover:text-blue-600 font-semibold">⬅ Back to Dashboard</a>

        </div>
    </div>

</body>
</html>
