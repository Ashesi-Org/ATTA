<?php
// Report errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__ . "/../Functions/general_function.php");

// Include the core.php file
include_once(__DIR__ . "/../Settings/core.php");

// Get form data
$section_id = $_POST['subsection_id'];
$topic_id = $_POST['topic_id'];
$user_id = $_POST['user_id'];

// Get the status
$status = get_user_subsection_status($section_id, $user_id, $topic_id);

echo $status;