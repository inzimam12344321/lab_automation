<?php
// config/database.php

$host = 'localhost';       // Hostname
$dbname = 'lab_automation'; // Database name
$username = 'root';        // Database username
$password = '';            // Database password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: set the default fetch mode to associative arrays
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Display success message (for debugging purposes, can be removed in production)
    // echo "Database connected successfully!";
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}
?>
