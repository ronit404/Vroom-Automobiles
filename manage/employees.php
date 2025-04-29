<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

$employees = $conn->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
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

            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Manage Employees</h2>

            <!-- Form to Add Employee -->
            <form action="../php/add_employee.php" method="POST" class="space-y-5">
                <input type="text" name="name" placeholder="Employee Name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                <input type="text" name="position" placeholder="Position" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="submit"
                        class="w-full py-3 text-white bg-green-500 rounded-xl hover:bg-green-600 transition duration-200 font-semibold">Add Employee</button>
            </form>

            <h3 class="text-2xl font-semibold text-gray-800 mt-8 mb-4">Current Employees</h3>
            <ul class="space-y-3">
                <?php foreach ($employees as $emp): ?>
                    <li class="flex justify-between items-center bg-gray-100 p-3 rounded-lg shadow-sm hover:bg-gray-200 transition">
                        <span class="text-gray-800"><?php echo htmlspecialchars($emp['name']) . " - " . htmlspecialchars($emp['position']); ?></span>
                        <a href="../php/delete_employee.php?id=<?php echo $emp['id']; ?>" class="text-red-500 hover:text-red-600 font-semibold">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Back to Dashboard -->
            <a href="../dashboard.php" class="block mt-8 text-center text-blue-500 hover:text-blue-600 font-semibold">⬅ Back to Dashboard</a>

        </div>
    </div>

</body>
</html>
