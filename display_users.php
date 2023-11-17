<?php
include 'db.php';

$users = getAllUsers();

if ($users) {
    echo "<style>";
    echo "body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(90deg, #1e1e1e, #0d0d0d);
        color: #fff;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
    }";

    echo "table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px;
        text-align: center;
        border-radius: 8px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.1);
    }";

    echo "th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }";

    echo "th {
        background-color: #555;
        color: #fff;
    }";

    echo "tr:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }";

    echo ".back-button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 8px;
        transition: background 0.3s;
    }";

    echo ".back-button:hover {
        background-color: #45a049;
    }";
    echo "</style>";

    echo "<h2>Registered Users</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Address</th></tr>";

    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['first_name'] . "</td>";
        echo "<td>" . $user['last_name'] . "</td>";
        echo "<td>" . $user['address'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // Back to admin.php button
    echo '<form method="post" action="admin.php">
            <input type="submit" class="back-button" value="Back to Admin Panel">
          </form>';
} else {
    echo "No registered users.";
}
?>
