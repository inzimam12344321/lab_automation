<?php
session_start();

// Include database connection
include '../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user role from session
$user_role = $_SESSION['role'];

// Fetch reports from the database
$query = "SELECT * FROM reports";
$stmt = $conn->prepare($query);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch testings from the database
$query_testings = "SELECT * FROM testings";
$stmt_testings = $conn->prepare($query_testings);
$stmt_testings->execute();
$testings = $stmt_testings->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Dashboard - Lab Automation">
    <meta name="keywords" content="dashboard, admin, staff, lab automation">
    <meta name="author" content="Lab Automation Team">
    <title>Dashboard - Lab Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .folder {
            cursor: pointer;
        }

        .folder-content {
            display: none;
            margin-left: 20px;
        }

        .folder.active .folder-content {
            display: block;
        }
        /* Full-height sidebar */
.sidebar {
    width: 250px;
    background: linear-gradient(135deg, #4F46E5, #9333EA);
    color: white;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0; /* Ensure the sidebar stretches to the bottom */
    transition: left 0.3s ease;
    z-index: 1000;
    overflow-y: auto; /* Enable vertical scrolling */
    height: 100vh; /* Make the sidebar full height */
}

/* Adjust the folder content section to handle scrolling */
.folder-content {
    max-height: 400px; /* Limit the height of the content to avoid too much overflow */
    overflow-y: auto; /* Enable scroll for overflowing content */
}

/* Ensure the list items have space */
.sidebar ul {
    list-style-type: none;
    padding: 0;
    margin-top: 20px; /* Space from the logo or title at the top */
}
/* Full-height sidebar */
.sidebar {
    width: 250px;
    background: linear-gradient(135deg, #4F46E5, #9333EA);
    color: white;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0; /* Ensure the sidebar stretches to the bottom */
    transition: left 0.3s ease;
    z-index: 1000;
    overflow-y: auto; /* Enable vertical scrolling */
    height: 100vh; /* Make the sidebar full height */
}

/* Ensure the list items have space */
.sidebar ul {
    list-style-type: none;
    padding: 0;
    margin-top: 20px; /* Space from the logo or title at the top */
}

/* Folder content adjustment */
.folder-content {
    max-height: 400px; /* Limit the height of the content to avoid excessive overflow */
    overflow-y: auto; /* Enable scroll for overflowing content */
}


    </style>
</head>
<body class="bg-white flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gradient-to-r from-blue-500 via-purple-600 to-blue-700 text-white flex-shrink-0 p-6">
        <div class="text-2xl font-bold mb-8 text-center">Lab Automation</div>
        <ul class="space-y-4">
            <li><a href="dashboard.php" class="hover:bg-blue-500 py-2 px-4 rounded-md block">Dashboard</a></li>
            
            <!-- Admin role links -->
            <?php if ($user_role == 'admin'): ?>
                <div class="folder">
                    <li class="hover:bg-blue-500 py-2 px-4 rounded-md block">Manage Users</li>
                    <div class="folder-content">
                        <ul>
                            <li><a href="users/add_user.php" class="text-white py-2 px-4 block">Add User</a></li>
                            <li><a href="users/view_users.php" class="text-white py-2 px-4 block">View Users</a></li>
                            <li><a href="users/edit_user.php" class="text-white py-2 px-4 block">Edit Users</a></li>
                            <li><a href="users/delete_user.php" class="text-white py-2 px-4 block">Delete Users</a></li>
                        </ul>
                    </div>
                </div>

                <div class="folder">
                    <li class="hover:bg-blue-500 py-2 px-4 rounded-md block">Manage Categories</li>
                    <div class="folder-content">
                        <ul>
                            <li><a href="categories/add_category.php" class="text-white py-2 px-4 block">Add Category</a></li>
                            <li><a href="categories/view_categories.php" class="text-white py-2 px-4 block">View Categories</a></li>
                            <li><a href="categories/edit_category.php" class="text-white py-2 px-4 block">Edit Categories</a></li>
                            <!-- <li><a href="categories/delete_category.php" class="text-white py-2 px-4 block">Delete Categories</a></li> -->
                        </ul>
                    </div>
                </div>

                <div class="folder">
                    <li class="hover:bg-blue-500 py-2 px-4 rounded-md block">Manage Reports</li>
                    <div class="folder-content">
                        <ul>
                            <li><a href="reports/add_report.php" class="text-white py-2 px-4 block">Add Report</a></li>
                            <li><a href="reports/view_reports.php" class="text-white py-2 px-4 block">View Reports</a></li>
                            <li><a href="reports/edit_report.php" class="text-white py-2 px-4 block">Edit Reports</a></li>
                            <li><a href="reports/delete_report.php" class="text-white py-2 px-4 block">Delete Reports</a></li>
                        </ul>
                    </div>
                </div>

                <div class="folder">
                    <li class="hover:bg-blue-500 py-2 px-4 rounded-md block">Manage Testings</li>
                    <div class="folder-content">
                        <ul>
                            <li><a href="testings/add_testing.php" class="text-white py-2 px-4 block">Add Testing</a></li>
                            <li><a href="testings/view_testings.php" class="text-white py-2 px-4 block">View Testings</a></li>
                            <li><a href="testings/edit_testing.php" class="text-white py-2 px-4 block">Edit Testings</a></li>
                            <li><a href="testings/delete_testing.php" class="text-white py-2 px-4 block">Delete Testings</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Staff role links -->
            <?php if ($user_role == 'staff'): ?>
                <div class="folder">
                    <li class="hover:bg-blue-500 py-2 px-4 rounded-md block">Manage Reports</li>
                    <div class="folder-content">
                        <ul>
                            <li><a href="reports/add_report.php" class="text-white py-2 px-4 block">Add Report</a></li>
                            <li><a href="reports/view_reports.php" class="text-white py-2 px-4 block">View Reports</a></li>
                        </ul>
                    </div>
                </div>

                <div class="folder">
                    <li class="hover:bg-blue-500 py-2 px-4 rounded-md block">Manage Testings</li>
                    <div class="folder-content">
                        <ul>
                            <li><a href="testings/add_testing.php" class="text-white py-2 px-4 block">Add Testing</a></li>
                            <li><a href="testings/view_testings.php" class="text-white py-2 px-4 block">View Testings</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <li><a href="../auth/logout.php" class="text-white py-2 px-4 rounded-md block">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Welcome Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-blue-600 mb-6">Welcome to Your Dashboard, <?php echo $_SESSION['user_name']; ?>!</h1>
            <p class="text-lg">Explore the different sections based on your role.</p>
        </div>

        <!-- Reports Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Manage Reports</h2>
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Result</th>
                        <th class="px-4 py-2 text-left">Created At</th>
                        <?php if ($user_role == 'admin'): ?>
                            <th class="px-4 py-2 text-left">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?php echo $report['id']; ?></td>
                            <td class="px-4 py-2"><?php echo $report['result']; ?></td>
                            <td class="px-4 py-2"><?php echo $report['created_at']; ?></td>
                            <?php if ($user_role == 'admin'): ?>
                                <td class="px-4 py-2">
                                    <a href="reports/edit_report.php?id=<?php echo $report['id']; ?>" class="text-blue-500 hover:text-blue-700 hover:underline">Edit</a>
                                    |
                                    <a href="reports/delete_report.php?id=<?php echo $report['id']; ?>" class="text-red-500 hover:text-red-700 hover:underline">Delete</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Toggle folder visibility
        document.querySelectorAll('.folder').forEach(function(folder) {
            folder.addEventListener('click', function() {
                folder.classList.toggle('active');
            });
        });
    </script>

</body>
</html>
