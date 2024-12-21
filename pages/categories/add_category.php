<?php
session_start();
include '../../config/database.php';

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "You are not authorized to add categories.";
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Insert the new category into the database
    $query = "INSERT INTO categories (name, description) VALUES (:name, :description)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Category added successfully!";
        header("Location: view_categories.php");
        exit();
    } else {
        $_SESSION['message'] = "Error adding category.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Lab Automation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-8">
        <h1 class="text-3xl font-bold text-center mb-6">Add Category</h1>

        <!-- Show success or error message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-blue-500 text-white p-4 rounded mb-4">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Category Form -->
        <form action="add_category.php" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold">Category Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded-md"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Add Category</button>
        </form>
    </div>

</body>
</html>
