<?php
session_start(); // Start the session
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php"); // Redirect to login if not logged in
    exit;
}

$id = $_SESSION['user_id']; // Dynamic ID from session
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];

    // Handle image upload
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
        $target_dir = "../resources/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $profile_image = $target_file;
        } else {
            $profile_image = $user['profile_image']; // Use existing image if upload fails
            echo "Error uploading file.";
        }
    } else {
        $profile_image = $user['profile_image']; // Use existing image if no new image is uploaded
    }

    $sql = "UPDATE users SET firstname = '$firstname', email = '$email', dob = '$dob', profile_image = '$profile_image' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated!";
        header("Location: profile.php"); // Refresh to reflect changes
        exit;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        .button-container {
            margin-top: 20px;
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>User Profile</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required><br>

        <label for="profile_image">Profile Image:</label><br>
        <input type="file" id="profile_image" name="profile_image"><br><br>

        <input type="submit" value="Update Profile">
    </form>

    <?php if (isset($user['profile_image']) && !empty($user['profile_image'])): ?>
        <h3>Current Profile Image:</h3>
        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" width="150">
    <?php endif; ?>

    <!-- Go to Dashboard Button -->
    <div class="button-container">
        <a href="../public/users.php" class="button">Go to Dashboard</a>
    </div>
</body>
</html>
