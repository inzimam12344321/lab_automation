<?php
session_start();
include '../../config/database.php';

// Fetch all categories for the dropdown
$query = "SELECT * FROM categories";
$stmt = $conn->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Insert the new test into the database
    $query = "INSERT INTO testings (category_id, name, price) VALUES (:category_id, :name, :price)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Test added successfully!";
        header("Location: view_testings.php");
        exit();
    } else {
        $_SESSION['message'] = "Error adding test.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Add New Test</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Test Name</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" required step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700">Add Test</button>
            </div>
        </form>
    </div>
</body>
</html>
