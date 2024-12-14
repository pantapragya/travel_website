<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP
$dbname = "travel_website";

// Start the session
session_start();

// Retrieve form data
$email = $_POST['email'];
$contact = $_POST['contact'];
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password securely

// Create a connection to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $user, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // User already exists
    echo "<script>
        alert('User already exists! Please try a different username or email.');
        window.location.href = 'signup.html';
    </script>";
} else {
    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (email, contact, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $contact, $user, $pass);

    if ($stmt->execute()) {
        // Successful signup
        echo "<script>
            alert('Signup successful! You can now log in.');
            window.location.href = 'signin.html';
        </script>";
    } else {
        // Error in insertion
        echo "<script>
            alert('An error occurred during signup. Please try again.');
            window.location.href = 'signup.html';
        </script>";
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
