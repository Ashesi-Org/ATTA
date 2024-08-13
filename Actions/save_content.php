<?php
include_once(__DIR__ . "/../Settings/core.php");
include_once(__DIR__ . "/../Functions/general_function.php");

if (!logged_in() || !is_admin()) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subtopic_id = $_POST['subtopic_id'];
    $content = $_POST['content'];
    $style = $_POST['style'];

    // Update the content in the database
    $result = update_subsection_content($subtopic_id, $content, $style);

    if ($result) {
        echo "Content saved successfully";
    } else {
        echo "Error saving content";
    }
}
?>
