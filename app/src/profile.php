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
        /* General Page Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1b1b1b;
            color: #e6e6e6;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        h3 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            background-color: #2b2b2b;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        label {
            font-size: 18px;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px;
            border: 1px solid #404040;
            border-radius: 4px;
            background-color: #333;
            color: #e6e6e6;
        }

        input[type="file"] {
            margin: 10px 0;
        }

        input[type="submit"] {
            background-color: #44cc00; /* Green */
            color: #1b1b1b;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #99ff66;
        }

        /* Button Styles */
        .button-container {
            margin-top: 20px;
            text-align: center;
        }

        .button {
            background-color: #44cc00; /* Green */
            color: #1b1b1b;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #99ff66;
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