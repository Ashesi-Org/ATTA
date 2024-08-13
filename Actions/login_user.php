<?php

// Error reporting
// Uncomment for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__ . "/../Functions/general_function.php");
include_once(__DIR__ . "/../Settings/core.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get the email and password from the AJAX request
$email = $_POST['email'];
$password = $_POST['password'];

// if the email or password is not empty
if (empty($email) || empty($password)) {
    // Return a JSON response for an error
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields']);
    return;
}

// Check if the email exists and the password is correct
if (login_user($email, $password)) {
    // Set the id in the session
    $_SESSION['user_id'] = get_user_id($email);

    // Return a JSON response
    echo json_encode(['status' => 'success']);
} else {
    // Return a JSON response for an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid login credentials']);
}
?>
