<?php
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Store user information in session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        
        // Redirect to users.php with success parameter
        header("Location: ../public/users.php?login=success");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with this email.";
}

$conn->close();
?>