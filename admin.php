<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include 'db.php';

// Function to check if a user is an admin
if (!function_exists('checkAdminStatus')) {
    function checkAdminStatus($username) {
        return (isset($conn) && loginUser($username, '')) ? true : false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        echo "Logging out... Redirecting to homepage.";
        session_unset();
        session_destroy();
        header("refresh:2;url=index.html");
        exit();
    }

    $username = $_POST['username'] ?? ''; // Set a default value if not set
    $password = $_POST['password'] ?? ''; // Set a default value if not set

    $result = loginUser($username, $password);

    if ($result) {
        if (checkAdminStatus($username)) {
            $_SESSION['username'] = $username;
        } else {
            $errorMessage = "Access denied. Only admins can enter the admin panel.";
        }
    } else {
        $errorMessage = "Invalid username or password";
    }
}

if (isset($_SESSION['username']) && checkAdminStatus($_SESSION['username'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Panel</title>                 <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(90deg, #1e1e1e, #0d0d0d);
                color: #fff;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                overflow: hidden;
            }
            h1 {
                color: #4CAF50;
                text-align: center;
            }
            ul {
                list-style-type: none;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            li {
                margin-bottom: 10px;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background: rgba(255, 255, 255, 0.2);
                color: #fff;
                text-decoration: none;
                border-radius: 8px;
                transition: background 0.3s;
                backdrop-filter: blur(10px);
            }
            .button:hover {
                background: rgba(255, 255, 255, 0.3);
            }
            form {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 20px; /* Added margin for better spacing */
            }
            input[type="submit"] {
                margin-top: 10px;
                background: #4CAF50;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background 0.3s;
            }
            input[type="submit"]:hover {
                background: #45a049;
            }
        </style>
   </head>
    <body>
    <h1>Welcome to the Admin Panel, <?php echo $_SESSION['username']; ?></h1>

    <div>
        <h2>Admin Actions</h2>
        <ul>
            <li><a class="button" href="add_user.php">Add User</a></li>
            <li><a class="button" href="delete_user.php">Delete User</a></li>
            <li><a class="button" href="display_users.php">Display User</a></li>
            <li><a class="button" href="edit_user.php">Edit User</a></li>
            <li><a class="button" href="search_users.php">Search User</a></li>
            <li><a class="button" href="reviews.php">User Reviews</a></li>
        </ul>

        <form method="post" action="">
            <input type="submit" name="logout" value="Log Out">
        </form>
    </div>

    </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Panel</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(90deg, #1e1e1e, #0d0d0d);
                color: #fff;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                overflow: hidden;
            }
            h1 {
                color: #fff;
                text-align: center;
            }
            form {
                display: flex;
                flex-direction: column;
                align-items: center;
                background: rgba(255, 255, 255, 0.1);
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            label {
                color: #fff;
                margin-bottom: 8px;
            }
            input {
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
                background-color: rgba(255, 255, 255, 0.3);
                color: #fff;
                width: 100%;
                box-sizing: border-box;
            }
            input[type="submit"] {
                background: #4CAF50;
                color: #fff;
                cursor: pointer;
                transition: background 0.3s;
            }
            input[type="submit"]:hover {
                background: #45a049;
            }
        </style>    </head>
    <body>
    <h1>Welcome to the Admin Panel</h1>

    <?php if (isset($errorMessage)) : ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Log In">
    </form>

    </body>
    </html>
    <?php
}
?>
