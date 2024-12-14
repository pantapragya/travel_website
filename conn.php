<?php
$servername = "localhost"; 
$username = "yourUsername"; 
$password = "yourPassword"; 
$dbname = "yourDatabase"; 
$conn =mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$conn->close();
?>