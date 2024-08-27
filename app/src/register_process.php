<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_management', 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Encrypt password
$dob = $_POST['dob'];

// Insert data into the database
$sql = "INSERT INTO users (firstname, lastname, email, mobile, password, dob)
        VALUES ('$firstname', '$lastname', '$email', '$mobile', '$password', '$dob')";

if ($conn->query($sql) === TRUE) {
    // Registration successful, redirect to login page
    header("Location: ../public/login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
