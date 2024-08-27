<?php
include 'db.php';

$id = $_GET['id'];

// Fetch the user details
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];

    $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', mobile = '$mobile', dob = '$dob' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to users.php with success parameter
        header("Location: ../public/users.php?edit=success");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>

    <!-- "Go to Dashboard" button -->
    <a href="../public/users.php" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#4CAF50; color:white; text-decoration:none; border-radius:5px;">Go to Dashboard</a>

    <form method="post">
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required><br>

        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label for="mobile">Mobile:</label><br>
        <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
