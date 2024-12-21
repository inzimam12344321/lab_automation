<?php
session_start();

// Database connection parameters
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'lab_automation';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if (isset($_SESSION['message'])) {
    echo "<div class='text-center text-green-600 mb-4'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h1 class="text-2xl font-bold text-center mb-6">User List</h1>

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Role</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                <tr class="border-t">
                    <td class="px-4 py-2"><?php echo $user['id']; ?></td>
                    <td class="px-4 py-2"><?php echo $user['name']; ?></td>
                    <td class="px-4 py-2"><?php echo $user['email']; ?></td>
                    <td class="px-4 py-2"><?php echo $user['role']; ?></td>
                    <td class="px-4 py-2">
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="text-blue-600 hover:underline">Edit</a> | 
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="text-red-600 hover:underline">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
