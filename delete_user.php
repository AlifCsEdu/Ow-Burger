<?php
include 'db.php';

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user
    $result = deleteUser($userId);

    if ($result) {
        echo "User deleted successfully.";
    } else {
        echo "Failed to delete user.";
    }

    // Redirect back to the admin panel after 2 seconds
    echo '<script>
            setTimeout(function () {
                window.location.href = "admin.php";
            }, 2000);
          </script>';
    exit;
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
    <title>Delete User</title>
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

        .delete-button {
            background-color: #ff6347; /* Tomato color for delete button */
            color: #fff;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-button:hover {
            background-color: #d63333; /* Darker red on hover */
        }
        .back-button {
            background-color: #4CAF50; /* Green color for back button */
            color: #fff;
            border: none;
            padding: 6px 12px;
            text-decoration: none; /* Remove underline from anchor tag */
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 20px; /* Add margin for spacing */
        }

        .back-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

    </style>
</head>
<body>
<h2>Delete User</h2>
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
                <form method="get" action="delete_user.php">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button class="delete-button" type="submit">&#10006;</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="admin.php" class="back-button">&#8592; Back to Admin Panel</a>

</body>
</html>
