<?php
session_start();
include '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get test ID from URL
if (!isset($_GET['id'])) {
    header("Location: view_testings.php");
    exit();
}

$test_id = $_GET['id'];

// Delete the test from the database
$query = "DELETE FROM testings WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $test_id);

if ($stmt->execute()) {
    $_SESSION['message'] = "Test deleted successfully!";
} else {
    $_SESSION['message'] = "Error deleting test.";
}

header("Location: view_testings.php");
exit();
?>
