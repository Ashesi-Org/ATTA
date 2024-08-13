<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once('../Settings/core.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Assign the style to a session variable
if (isset($_POST['learning_style'])) {
    $_SESSION['learning_style'] = $_POST['learning_style'];
    echo $_SESSION['learning_style'];
}
?>
