<?php

// Error reporting
// Uncomment for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__. "/../Functions/general_function.php");
include_once(__DIR__. "/../Settings/core.php");


// Get the first name, last name, email, password and confirm password
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if the first name is empty
if (empty($fname)) {
    $_SESSION['message'] = "firstname";
    header("Location: ../signup.php");
    exit();
}

// Check if the email is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
    exit();
}

// Check if the password is at least 8 characters long
if (strlen($password) < 8) {
    echo "Password must be at least 8 characters long";
    exit();
}

// Check if the password and confirm password match
if ($password != $confirm_password) {
    echo "Passwords do not match";
    exit();
}


// Register the user
if (register_user($fname, $lname, $email, $password)) {
      // Message
      $_SESSION['message'] = "Registration";
      
    // Redirect to the pretest page
    header("Location: ../style-pretest.php?user_id=".get_user_id($email));
    // header("Location: ../login.php");
} else {
    echo "User registration failed";
}


?>