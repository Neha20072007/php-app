<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        }

        .toast.show {
            visibility: visible;
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
    <h2>Login Form</h2>
    <form action="../src/login_process.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>

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
