<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user data from the form
    $userId = $_POST['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0; // Check if the "Is Admin" checkbox is checked

    // Update the user details
    $result = updateUser($userId, $firstName, $lastName, $address, $isAdmin);

    if ($result) {
        echo "User updated successfully.";
    } else {
        echo "Failed to update user.";
    }
}

// Retrieve all users for display
$users = getAllUsers();

if (!$users) {
    echo "Failed to retrieve users.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
            text-align: center;
            border-radius: 8px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #555;
            color: #fff;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .edit-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit-button:hover {
            background-color: #45a049;
        }

        .back-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #555;
        }    h2 {
                 text-align: center;
             }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin: 10px 0;
        }

        input {
            padding: 8px;
            margin: 5px 0;
        }

        .user-details {
            margin: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        .back-button {
                 background-color: #333;
                 color: #fff;
                 border: none;
                 padding: 6px 12px;
                 cursor: pointer;
                 border-radius: 4px;
                 margin-top: auto;
                 text-decoration: none; /* To remove the underline for links */
                 display: inline-block; /* Make it inline with the form elements */
                 transition: background-color 0.3s; /* Smooth transition on hover */
             }

        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<a class="back-button" href="admin.php">Back to Admin</a>

<?php if (isset($_GET['id'])) : ?>
    <h2>Edit User</h2>
    <?php
    $userId = $_GET['id'];
    $user = getUserById($userId);

    if ($user) : ?>
        <form method="POST">
            <input type="hidden" name="userId" value="<?php echo $userId; ?>">
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" value="<?php echo $user['first_name']; ?>" required><br>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" value="<?php echo $user['last_name']; ?>" required><br>

            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo $user['address']; ?>" required><br>

            <label for="isAdmin">Is Admin:</label>
            <input type="checkbox" name="isAdmin" <?php if ($user['is_admin'] == 1) echo "checked"; ?>><br>

            <input type="submit" value="Update User">
        </form>
        <form method="get" action="edit_user.php">
            <button class="back-button" type="submit">Back to Users</button>
        </form>
    <?php else : ?>
        <p>User not found.</p>
    <?php endif; ?>
<?php else : ?>
    <h2>Edit Users</h2>
    <?php if (!empty($users)) : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td>
                        <form method="get" action="edit_user.php">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button class="edit-button" type="submit">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No users available for editing.</p>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>
