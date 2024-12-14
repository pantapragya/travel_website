<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to sign-in page if not logged in
    header("Location: signin.html");
    exit;
}

// Welcome the user
// echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
header("Location: index.html"); // Redirect to the home page (index.html)
// echo "<a href='logout.php'>Log Out</a>";
?>
