<?php
session_start(); // Start the session
include '../src/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php"); // Redirect to login if not logged in
    exit;
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID from the session

// Fetch the logged-in user's details
$user_sql = "SELECT firstname, lastname, profile_image FROM users WHERE id = $user_id";
$user_result = $conn->query($user_sql);
$logged_in_user = $user_result->fetch_assoc();

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: ../public/login.php"); // Redirect to login page after logout
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
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

        /* Welcome and Profile Section */
        .welcome-title {
            font-size: 36px; /* Increase font size */
            font-weight: bold; /* Make text bold */
            margin-top: 20px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .profile-picture {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            vertical-align: middle;
        }

        /* Button Styles */
        .view-profile-btn, .logout-btn {
            background-color: #44cc00;
            color: #1b1b1b;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .view-profile-btn:hover {
            background-color: #99ff66;
        }

        .logout-btn {
            background-color: #f44336;
        }

        .logout-btn:hover {
            background-color: #ff6666;
        }

        /* Table Styles */
        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #2b2b2b;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #404040;
        }

        th {
            background-color: #404040;
            color: #e6e6e6;
        }

        td {
            color: #b3b3b3;
        }

        a {
            color: #99ff66;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Ensure the container takes full width */
        .button-container {
            width: 100%;
            text-align: right;
        }

        /* Optional: Add some spacing between buttons */
        .button-container a,
        .button-container form {
            margin-left: 10px;
        }


        /* Toast Styles */
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
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .toast.show {
            visibility: visible;
            opacity: 1;
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

        /* Responsiveness */
        @media (max-width: 768px) {
            body {
                padding: 20px;
            }
            
            table {
                width: 100%;
                font-size: 14px;
            }
            
            .view-profile-btn, .logout-btn {
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- View Profile and Logout buttons -->
    <div class="button-container">
        <a href="../src/profile.php" class="view-profile-btn">View Profile</a>
        <form method="post" style="display:inline;">
            <input type="submit" name="logout" value="Logout" class="logout-btn">
        </form>
    </div>

    <!-- User Welcome Section -->
    <div class="welcome-title">
        <?php if (!empty($logged_in_user['profile_image'])): ?>
            <img src="<?php echo htmlspecialchars($logged_in_user['profile_image']); ?>" alt="Profile Picture" class="profile-picture">
        <?php endif; ?>
        Welcome to UserNest 🪺, <?php echo htmlspecialchars($logged_in_user['firstname']) . ' ' . htmlspecialchars($logged_in_user['lastname']); ?>!
    </div>

    <h2>Inspect List of Registered Users 🕊️</h2>

    <!-- Users Table -->
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Date of Birth</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
            <td><?php echo htmlspecialchars($row['dob']); ?></td>
            <td>
                <a href="../src/update_user.php?id=<?php echo htmlspecialchars($row['id']); ?>">Edit</a> |
                <a href="../src/delete_user.php?id=<?php echo htmlspecialchars($row['id']); ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Toast Notifications -->
    <div id="loginToast" class="toast">You have successfully logged in!</div>
    <div id="deleteToast" class="toast">User has been successfully deleted!</div>
    <div id="editToast" class="toast">User information has been successfully updated!</div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);

            // Show login toast if 'login' parameter is present
            if (urlParams.get('login') === 'success') {
                const loginToast = document.getElementById('loginToast');
                loginToast.className = 'toast show';
                setTimeout(() => {
                    loginToast.className = loginToast.className.replace('show', '');
                }, 5000);
            }

            // Show delete toast if 'delete' parameter is present
            if (urlParams.get('delete') === 'success') {
                const deleteToast = document.getElementById('deleteToast');
                deleteToast.className = 'toast show';
                setTimeout(() => {
                    deleteToast.className = deleteToast.className.replace('show', '');
                }, 5000);
            }

            // Show edit toast if 'edit' parameter is present
            if (urlParams.get('edit') === 'success') {
                const editToast = document.getElementById('editToast');
                editToast.className = 'toast show';
                setTimeout(() => {
                    editToast.className = editToast.className.replace('show', '');
                }, 5000);
            }
        });
    </script>
</body>
</html>
