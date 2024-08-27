<?php
include '../src/db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
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
    </style>
</head>
<body>
    <h2>List of Registered Users</h2>
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
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['dob']; ?></td>
            <td>
                <a href="../src/update_user.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="../src/delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
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
                }, 3000);
            }

            // Show delete toast if 'delete' parameter is present
            if (urlParams.get('delete') === 'success') {
                const deleteToast = document.getElementById('deleteToast');
                deleteToast.className = 'toast show';
                setTimeout(() => {
                    deleteToast.className = deleteToast.className.replace('show', '');
                }, 3000);
            }

            // Show edit toast if 'edit' parameter is present
            if (urlParams.get('edit') === 'success') {
                const editToast = document.getElementById('editToast');
                editToast.className = 'toast show';
                setTimeout(() => {
                    editToast.className = editToast.className.replace('show', '');
                }, 3000);
            }
        });
    </script>
</body>
</html>
