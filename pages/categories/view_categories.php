<?php
session_start();
include '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all categories
$query = "SELECT * FROM categories";
$stmt = $conn->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories - Lab Automation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-8">
        <h1 class="text-3xl font-bold text-center mb-6">All Categories</h1>

        <!-- Show success or error message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-blue-500 text-white p-4 rounded mb-4">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Categories Table -->
        <table class="min-w-full bg-white border border-gray-300 rounded-md">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Category Name</th>
                    <th class="py-2 px-4 text-left">Description</th>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <th class="py-2 px-4 text-left">Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td class="py-2 px-4"><?php echo $category['id']; ?></td>
                        <td class="py-2 px-4"><?php echo $category['name']; ?></td>
                        <td class="py-2 px-4"><?php echo $category['description']; ?></td>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <td class="py-2 px-4">
                                <a href="edit_category.php?id=<?php echo $category['id']; ?>" class="text-blue-500 hover:text-blue-700">Edit</a> 
                                <!-- <a href="delete_category.php?id=<?php echo $category['id']; ?>" class="text-red-500 hover:text-red-700">Delete</a> -->
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
