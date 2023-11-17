<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user data from the form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0; // Check if the "Is Admin" checkbox is checked
    $password = $_POST['password']; // Get the password from the form

    // Add the user to the database
    $result = addUser($firstName, $lastName, $address, $password, $isAdmin);

    if ($result) {
        echo "User added successfully.";
    } else {
        echo "Failed to add user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            width: 300px;
            transition: all 0.3s ease-in-out; /* Add smooth transition */
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
            transition: background 0.3s;
        }

        input[type="checkbox"] {
            margin-top: 5px;
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

        button {
            margin-top: 10px;
            background: #555;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #333;
        }
    </style>
</head>
<body>
<h2>Add User</h2>
<form method="POST">
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" required>

    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" required>

    <label for="address">Address:</label>
    <input type="text" name="address" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="isAdmin">Is Admin:</label>
    <input type="checkbox" name="isAdmin">

    <input type="submit" value="Add User">
</form>

<!-- Back button to admin.php -->
<form method="get" action="admin.php">
    <button type="submit">Back to Admin Panel</button>
</form>
</body>
</html>
