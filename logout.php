<?php
// Start session
session_start();

// Destroy the session
session_destroy();

// Redirect to sign-in page
header("Location: signin.html");
exit;
?>