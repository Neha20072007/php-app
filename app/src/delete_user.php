<?php
include 'db.php';

$id = $_GET['id'];

// Delete the user from the database
$sql = "DELETE FROM users WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Redirect to users.php with success parameter
    header("Location: ../public/users.php?delete=success");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>