<?php
$servername = "localhost";
$username = "root";  // Change if your MySQL username is different
$password = "";  // Replace with your MySQL root password
$dbname = "user_management";  // Ensure this matches your database name
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>