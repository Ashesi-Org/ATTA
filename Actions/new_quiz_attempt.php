<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__ . "/../Functions/general_function.php");

// Include the core.php file
include_once(__DIR__ . "/../Settings/core.php");

if (!isset($_POST['new_quiz_attempt'])) {
    $_SESSION['new_quiz_attempt'] = 1;

    $topic_id = $_POST['topic_id'];

    $topic = $_POST['topic'];

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>