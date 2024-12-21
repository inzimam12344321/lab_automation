<?php
session_start();
include '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all reports with user and test details
$query = "SELECT reports.id, users.name AS user_name, testings.name AS testing_name, reports.result, reports.created_at 
          FROM reports 
          JOIN users ON reports.user_id = users.id 
          JOIN testings ON reports.testing_id = testings.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">All Reports</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left">Report ID</th>
                    <th class="px-6 py-3 text-left">User</th>
                    <th class="px-6 py-3 text-left">Test</th>
                    <th class="px-6 py-3 text-left">Result</th>
                    <th class="px-6 py-3 text-left">Created At</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                    <tr class="border-b">
                        <td class="px-6 py-4"><?php echo $report['id']; ?></td>
                        <td class="px-6 py-4"><?php echo $report['user_name']; ?></td>
                        <td class="px-6 py-4"><?php echo $report['testing_name']; ?></td>
                        <td class="px-6 py-4"><?php echo $report['result']; ?></td>
                        <td class="px-6 py-4"><?php echo $report['created_at']; ?></td>
                        <td class="px-6 py-4">
                            <a href="edit_report.php?id=<?php echo $report['id']; ?>" class="text-blue-600 hover:text-blue-800">Edit</a> |
                            <a href="delete_report.php?id=<?php echo $report['id']; ?>" class="text-red-600 hover:text-red-800">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
