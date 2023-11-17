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

    $sql = "INSERT INTO users (first_name, last_name, address, password, is_admin) VALUES ('$firstName', '$lastName', '$address', '$password', 0)";

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
function checkAdminStatus($username) {
    global $conn;
    $username = sanitize($username);

    $sql = "SELECT is_admin FROM users WHERE first_name = '$username' OR last_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['is_admin'] == 1;
    } else {
        return false;
    }
}

function addUser($firstName, $lastName, $address, $password, $isAdmin) {
    global $conn;

    $firstName = sanitize($firstName);
    $lastName = sanitize($lastName);
    $address = sanitize($address);
    $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (first_name, last_name, address, password, is_admin) 
            VALUES ('$firstName', '$lastName', '$address', '$password', $isAdmin)";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function getAllUsers() {
    global $conn;

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    } else {
        return false;
    }
}

function deleteUser($userId) {
    global $conn;

    $userId = sanitize($userId);

    $sql = "DELETE FROM users WHERE id = '$userId'";
    $result = $conn->query($sql);

    return $result;
}

function getUserById($userId) {
    global $conn;

    $userId = sanitize($userId);

    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

function updateUser($userId, $firstName, $lastName, $address, $isAdmin) {
    global $conn;

    $userId = sanitize($userId);
    $firstName = sanitize($firstName);
    $lastName = sanitize($lastName);
    $address = sanitize($address);

    $sql = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', address = '$address', is_admin = $isAdmin WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function getReviews() {
    global $conn;

    $sql = "SELECT * FROM reviews";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
        return $reviews;
    } else {
        return false;
    }
}
function stars($rating) {
    $output = '';
    for ($i = 1; $i <= 5; $i++) {
        $output .= ($i <= $rating) ? '★' : '☆';
    }
    return $output;
}
?>