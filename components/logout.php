<?php
session_start(); // Start the session

// Clear all session data
session_unset();

// Destroy the session
session_destroy();

// Redirect to a logged-out page or the login page
header("Location: login.php"); // Change "login.php" to the appropriate page
exit(); // Ensure you stop executing the current script after the header redirect
?>
