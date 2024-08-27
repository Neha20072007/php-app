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
        /* Toast container */
        .toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 30px; /* Position at the top */
            font-size: 17px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
            padding: 16px;
            box-sizing: border-box;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .toast.show {
            visibility: visible;
            opacity: 1;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @-webkit-keyframes fadeout {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        @keyframes fadeout {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        /* Button Styles */
        .view-profile-btn, .logout-btn {
            float: right;
            margin: 10px;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .view-profile-btn:hover, .logout-btn:hover {
            background-color: #45a049; /* Darker green */
        }

        .logout-btn {
            background-color: #f44336; /* Red for logout */
        }

        /* Profile picture */
        .profile-picture {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            vertical-align: middle;
        }

        /* Welcome title */
        .welcome-title {
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Display the user's profile picture and welcome title -->
    <div class="welcome-title">
        <?php if (!empty($logged_in_user['profile_image'])): ?>
            <img src="<?php echo htmlspecialchars($logged_in_user['profile_image']); ?>" alt="Profile Picture" class="profile-picture">
        <?php endif; ?>
        Welcome to UserNest 🪺, <?php echo htmlspecialchars($logged_in_user['firstname']) . ' ' . htmlspecialchars($logged_in_user['lastname']); ?>!
    </div>

    <h2>Inspect List of Registered Users 🕊️</h2>
    
    <!-- 'View Profile' button -->
    <a href="../src/profile.php" class="view-profile-btn">View Profile</a>
    
    <!-- Logout button -->
    <form method="post" style="display:inline;">
        <input type="submit" name="logout" value="Logout" class="logout-btn">
    </form>

    <table border="1">
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
