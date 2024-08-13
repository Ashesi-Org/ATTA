<?php

// Error reporting
// Uncomment for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

//  Include the core.php file
include_once(__DIR__. "/../Settings/core.php");

// Destroy the session
session_destroy();

// Redirect to the previous page
header("Location: " . $_SERVER['HTTP_REFERER']);

?>