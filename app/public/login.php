<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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

        input[type="email"],
        input[type="password"] {
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
            padding: 15px;
            border-radius: 8px;
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

        /* Toast container */
        .toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 30px;
            font-size: 17px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            padding: 16px;
            transform: translateX(-50%);
        }

        .toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeout {
            from { opacity: 1; }
            to { opacity: 0; }
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="image-container"></div> <!-- Left side image -->

        <div class="form-container">
            <h2>Login</h2>
            <form action="../src/login_process.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Login">
            </form>

            <p>Not registered yet? <a href="../public/register.php">Click here to register</a></p>

        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast">You have successfully registered!</div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Check if the URL has the 'registered' parameter
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('registered') === 'success') {
                // Show the toast notification
                const toast = document.getElementById('toast');
                toast.className = 'toast show';
                
                // Hide the toast after 3 seconds
                setTimeout(() => {
                    toast.className = toast.className.replace('show', '');
                }, 5000);
            }
        });
    </script>
</body>
</html>
