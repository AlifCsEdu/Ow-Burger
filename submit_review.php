<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

// User registration function
function registerUser($firstName, $lastName, $address, $password) {
    global $conn;
    $firstName = sanitize($firstName);
    $lastName = sanitize($lastName);
    $address = sanitize($address);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, address, password) VALUES ('$firstName', '$lastName', '$address', '$password')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// User login function
function loginUser($username, $password) {
    global $conn;
    $username = sanitize($username);

    $sql = "SELECT * FROM users WHERE first_name = '$username' OR last_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the rating and username from the request
    $rating = sanitize($_POST["rating"]);
    $username = sanitize($_POST["username"]);

    // Perform any additional validation if needed

    // Save the review to the database
    $sql = "INSERT INTO reviews (rating, username) VALUES ('$rating', '$username')";

    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false);
    }

    // Send the response as JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>