<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP
$dbname = "travel_website";

// Start the session
session_start();

// Retrieve user input
$user = $_POST['username'];
$pass = $_POST['password'];

// Create a connection to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query to check if the user exists
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

// Check if a user with the given username exists
if ($stmt->num_rows > 0) {
    // Fetch the hashed password from the database
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($pass, $hashed_password)) {
        // Password matches
        $_SESSION['username'] = $user; // Store user session
        header("Location: home.php"); // Redirect to home page
        exit;
    } else {
        // Password doesn't match
        echo "<script>alert('Incorrect password!'); window.location.href='signin.html';</script>";
    }
} else {
    // Username doesn't exist
    echo "<script>alert('Username does not exist!'); window.location.href='signin.html';</script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
