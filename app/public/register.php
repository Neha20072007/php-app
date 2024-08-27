<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        /* Overall page styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #1b1b1b;
            color: #e6e6e6;
        }

        /* Main container styling */
        .container {
            display: flex;
            background-color: #2b2b2b;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            max-width: 800px;
            width: 100%;
        }

        /* Left side (image) */
        .image-container {
            background: url('../resources/leaves.jpg') no-repeat center center/cover;
            width: 50%;
        }

        /* Right side (form) */
        .form-container {
            padding: 40px;
            width: 50%;
        }

        /* Form styling */
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #e6e6e6;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="submit"] {
            background-color: #404040;
            border: none;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            color: #e6e6e6;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #44cc00;
            border: none;
            font-size: 16px;
            color: #1b1b1b;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #99ff66;
        }

        /* Additional styling */
        p {
            font-size: 12px;
        }

        a {
            color: #99ff66;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-container"></div> <!-- Left side image -->

        <div class="form-container">
            <h2>Registration Form</h2>
            <form action="../src/register_process.php" method="post">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>

                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>

                <input type="submit" value="🍂Register🍂">
            </form>

            <p>Already registered? <a href="../public/login.php">Click here to login</a></p>
        </div>
    </div>
</body>
</html>
