<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destroy the session
session_destroy();

// Redirect to index.php after logging out
header("Location: index.php");
exit(); // Ensure no further code is executed after the redirect
?>