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

if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Invalid user ID.";
    header("Location: view_users.php");
    exit();
}

$user_id = $_GET['id'];

// Fetch the current user data
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// If no user found
if (!$user) {
    $_SESSION['message'] = "User not found.";
    header("Location: view_users.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password']; // Update only if password is provided
    $role = $_POST['role'];

    // Update user details
    $query = "UPDATE users SET name = '$name', email = '$email', password = '$password', role = '$role' WHERE id = $user_id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "User updated successfully!";
        header("Location: view_users.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating user: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h1 class="text-2xl font-bold text-center mb-6">Edit User</h1>

    <form method="POST" action="">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="staff" <?php if ($user['role'] == 'staff') echo 'selected'; ?>>Staff</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-md mt-4 hover:bg-blue-700 transition">Update User</button>
    </form>
</div>

</body>
</html>
