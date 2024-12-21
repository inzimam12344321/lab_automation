<?php
session_start();

// Database connection parameters
$host = 'localhost';
$user = 'root';  // Your MySQL username
$password = '';  // Your MySQL password
$dbname = 'lab_automation';  // Your database name

// Create a connection to the database using mysqli_connect
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "You are not authorized to add users.";
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash password
    $role = $_POST['role'];

    // Insert new user
    $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "User added successfully!";
        header("Location: view_users.php");
        exit();
    } else {
        $_SESSION['message'] = "Error adding user: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='text-center text-green-600 mb-4'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

    <h1 class="text-2xl font-bold text-center mb-6">Add New User</h1>

    <form method="POST" action="">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-md mt-4 hover:bg-blue-700 transition">Add User</button>
    </form>
</div>

</body>
</html>
