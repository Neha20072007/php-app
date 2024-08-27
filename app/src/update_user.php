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
    <style>
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
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
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
    <h2>Edit User</h2>

    <!-- "Go to Dashboard" button -->
    <a href="../public/users.php" class="button">Go to Dashboard</a>

    <form method="post">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>

        <input type="submit" value="Update">
    </form>

    <!-- Toast Notifications -->
    <div id="editUserToast" class="toast">User updated successfully!</div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);

            // Show user update toast if 'edit' parameter is present
            if (urlParams.get('edit') === 'success') {
                const editUserToast = document.getElementById('editUserToast');
                editUserToast.className = 'toast show';
                setTimeout(() => {
                    editUserToast.className = editUserToast.className.replace('show', '');
                }, 5000);
            }
        });
    </script>
</body>
</html>
