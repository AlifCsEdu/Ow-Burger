<?php
include 'db.php';

// Get user data from the request
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Login the user
$result = loginUser($username, $password);

// Send response as JSON
$response = array();
if ($result) {
    $response['success'] = true;
    $response['redirect'] = 'index.html';
} else {
    $response['success'] = false;
}
echo json_encode($response);
?>