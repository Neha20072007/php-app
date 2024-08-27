<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="../src/register_process.php" method="post">
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" required><br>

        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="mobile">Mobile:</label><br>
        <input type="text" id="mobile" name="mobile" required><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br><br>

        <input type="submit" value="Register">
    </form>

    <!-- Section for redirecting to login page -->
    <p>Already registered? <a href="../public/login.php">Click here to login</a></p>
</body>
</html>
