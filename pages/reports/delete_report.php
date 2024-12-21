<?php
session_start();
include '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get report ID from URL
if (!isset($_GET['id'])) {
    header("Location: view_reports.php");
    exit();
}

$report_id = $_GET['id'];

// Delete the report from the database
$query = "DELETE FROM reports WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $report_id);

if ($stmt->execute()) {
    $_SESSION['message'] = "Report deleted successfully!";
} else {
    $_SESSION['message'] = "Error deleting report.";
}

header("Location: view_reports.php");
exit();
?>
