<?php
// Start the session
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page or homepage after logging out
header("Location: login.php"); // Adjust the path to your login page
exit();
?>
