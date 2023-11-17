<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burgerorders";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the SQL query from the POST request
$sql = $_POST['sql'];

// Add a debugging statement to log the SQL query
error_log("SQL Query: " . $sql);

if ($conn->query($sql) === TRUE) {
    // Log a success message
    error_log("Order saved successfully");
    echo "Order saved successfully";
} else {
    // Log an error message
    error_log("Error: " . $sql . "<br>" . $conn->error);
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
