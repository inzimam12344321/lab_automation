<?php
session_start();
include '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all tests and join with categories
$query = "SELECT testings.id, testings.name, testings.price, testings.created_at, categories.name AS category_name FROM testings INNER JOIN categories ON testings.category_id = categories.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$testings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">All Tests</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left">Test ID</th>
                    <th class="px-6 py-3 text-left">Test Name</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Price</th>
                    <th class="px-6 py-3 text-left">Created At</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testings as $testing): ?>
                    <tr class="border-b">
                        <td class="px-6 py-4"><?php echo $testing['id']; ?></td>
                        <td class="px-6 py-4"><?php echo $testing['name']; ?></td>
                        <td class="px-6 py-4"><?php echo $testing['category_name']; ?></td>
                        <td class="px-6 py-4">$<?php echo number_format($testing['price'], 2); ?></td>
                        <td class="px-6 py-4"><?php echo $testing['created_at']; ?></td>
                        <td class="px-6 py-4">
                            <a href="edit_testing.php?id=<?php echo $testing['id']; ?>" class="text-blue-600 hover:text-blue-800">Edit</a> |
                            <a href="delete_testing.php?id=<?php echo $testing['id']; ?>" class="text-red-600 hover:text-red-800">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
