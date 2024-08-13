<?php
# report errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

# Set message session variable
$_SESSION['message'] = "Not Activated";

# Redirect to the previous page
header("Location: " . $_SERVER['HTTP_REFERER']);

?>