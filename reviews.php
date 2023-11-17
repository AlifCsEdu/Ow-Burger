<?php
include 'db.php';

// Retrieve reviews from the database
$reviews = getReviews();

if (!$reviews) {
    echo "Failed to retrieve reviews.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #282c34;
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
            background: rgba(255, 255, 255, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        th {
            background-color: #555;
            color: #fff;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .back-button {
            background-color: #61dafb;
            color: #fff;
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 20px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #4fa3d1;
        }
    </style>
</head>
<body>

<h2>Reviews</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Rating</th>
        <th>Username</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($reviews as $review) : ?>
        <tr>
            <td><?php echo $review['id']; ?></td>
            <td><?php echo stars($review['rating']); ?></td>
            <td><?php echo $review['username']; ?></td>
            <td><?php echo $review['created_at']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Back to admin.php button -->
<a class="back-button" href="admin.php">Back to Admin</a>

</body>
</html>
