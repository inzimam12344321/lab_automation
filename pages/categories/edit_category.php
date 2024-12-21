<?php
session_start();
include '../../config/database.php';

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "You are not authorized to edit categories.";
    header("Location: login.php");
    exit();
}

// Get category details
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $query = "SELECT * FROM categories WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $category_id);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        $_SESSION['message'] = "Category not found.";
        header("Location: view_categories.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Update the category in the database
    $query = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $category_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Category updated successfully!";
        header("Location: view_categories.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating category.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Lab Automation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-8">
        <h1 class="text-3xl font-bold text-center mb-6">Edit Category</h1>

        <!-- Show success or error message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-blue-500 text-white p-4 rounded mb-4">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Edit Category Form -->
        <form action="edit_category.php?id=<?php echo $category['id']; ?>" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold">Category Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-md" value="<?php echo $category['name']; ?>" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded-md"><?php echo $category['description']; ?></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Update Category</button>
        </form>
    </div>

</body>
</html>
