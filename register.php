<?php
include 'db.php';

// Get user data from the request
$data = json_decode(file_get_contents('php://input'), true);
$firstName = $data['firstName'];
$lastName = $data['lastName'];
$address = $data['address'];
$password = $data['password'];

// Register the user
$result = registerUser($firstName, $lastName, $address, $password);

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
