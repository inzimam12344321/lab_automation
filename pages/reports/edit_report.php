<?php
session_start();
include '../../config/database.php';

// Fetch all users and tests for the dropdowns
$query = "SELECT id, name FROM users";
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT id, name FROM testings";
$stmt = $conn->prepare($query);
$stmt->execute();
$testings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get report ID from URL
if (!isset($_GET['id'])) {
    header("Location: view_reports.php");
    exit();
}

$report_id = $_GET['id'];

// Fetch the report details
$query = "SELECT * FROM reports WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $report_id);
$stmt->execute();
$report = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $testing_id = $_POST['testing_id'];
    $result = $_POST['result'];

    // Update the report
    $query = "UPDATE reports SET user_id = :user_id, testing_id = :testing_id, result = :result WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':testing_id', $testing_id);
    $stmt->bindParam(':result', $result);
    $stmt->bindParam(':id', $report_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Report updated successfully!";
        header("Location: view_reports.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating report.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Edit Report</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" id="user_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>" <?php if ($user['id'] == $report['user_id']) echo 'selected'; ?>>
                            <?php echo $user['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="testing_id" class="block text-sm font-medium text-gray-700">Test</label>
                <select name="testing_id" id="testing_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <?php foreach ($testings as $testing): ?>
                        <option value="<?php echo $testing['id']; ?>" <?php if ($testing['id'] == $report['testing_id']) echo 'selected'; ?>>
                            <?php echo $testing['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="result" class="block text-sm font-medium text-gray-700">Result</label>
                <textarea name="result" id="result" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"><?php echo $report['result']; ?></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700">Update Report</button>
            </div>
        </form>
    </div>
</body>
</html>
