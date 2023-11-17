<?php
include 'db.php';

// Initialize variables
$searchResults = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get search term from the form
    $searchTerm = $_POST['searchTerm'];

    // Determine if the search term is a numeric ID
    $isNumericId = is_numeric($searchTerm);

    // Search for users by ID or name with exact ID match if numeric
    $sql = "SELECT * FROM users WHERE ";
    if ($isNumericId) {
        $sql .= "id = $searchTerm";
    } else {
        $sql .= "id LIKE '%$searchTerm%' OR first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $searchResults .= "<h2>Search Results</h2>";
        $searchResults .= "<table>";
        $searchResults .= "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Address</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $searchResults .= "<tr>";
            $searchResults .= "<td>" . $row['id'] . "</td>";
            $searchResults .= "<td>" . $row['first_name'] . "</td>";
            $searchResults .= "<td>" . $row['last_name'] . "</td>";
            $searchResults .= "<td>" . $row['address'] . "</td>";
            $searchResults .= "</tr>";
        }

        $searchResults .= "</table>";
    } else {
        $searchResults = "No matching users found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(90deg, #1e1e1e, #0d0d0d);
            color: #fff;
            margin: 0;
            display: flex;
            flex-direction: column;
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
            background: rgba(255, 255, 255, 0.2);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #555;
            color: #fff;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Search form styles */
        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
            color: #000;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* User note styles */
        p {
            margin-top: 20px;
            text-align: center;
        }

        /* Back button styles */
        .back-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<!-- Search form -->
<h2>Search Users</h2>
<form method="POST">
    <label for="searchTerm">Search Term:</label>
    <input type="text" name="searchTerm" required><br>
    <input type="submit" value="Search">
</form>

<!-- User note -->
<p>Note: The search term can be either the name or ID.</p>

<?php echo $searchResults; ?>

<!-- Back button after the search -->
<a class="back-button" href="search_users.php">Back to Search</a>

<!-- Back to admin.php button -->
<a class="back-button" href="admin.php">Back to Admin</a>

</body>
</html>
