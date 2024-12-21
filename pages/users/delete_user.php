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

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "You are not authorized to delete users.";
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Ensure the ID is an integer to avoid SQL injection
    $user_id = (int)$user_id;

    // Prepare and execute the delete query
    $query = "DELETE FROM users WHERE id = $user_id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "User deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting user: " . mysqli_error($conn);
    }
} else {
    $_SESSION['message'] = "No user ID provided.";
}

header("Location: view_users.php");
exit();
?>
