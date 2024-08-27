<?php
include 'db.php';

$id = 1; // Static ID for now, should be dynamic
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];

    // Handle image upload
    $target_dir = "../resources/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);

    $sql = "UPDATE users SET firstname = '$firstname', email = '$email', dob = '$dob', profile_image = '$target_file' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>" required><br>

        <label for="profile_image">Profile Image:</label><br>
        <input type="file" id="profile_image" name="profile_image"><br><br>

        <input type="submit" value="Update Profile">
    </form>
    <?php if (isset($user['profile_image'])): ?>
        <h3>Current Profile Image:</h3>
        <img src="<?php echo $user['profile_image']; ?>" alt="Profile Image" width="150">
    <?php endif; ?>
</body>
</html>
