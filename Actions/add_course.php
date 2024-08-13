<?php
// report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__. "/../Functions/general_function.php");

// Include the core.php file
include_once(__DIR__. "/../Settings/core.php");

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get Course ID
    $course_id = $_POST['course_id'];
    
    // Get logged in user ID
    $user_id = $_POST['student_id'];

    // Call the function to add the course to student list
    if (add_course($user_id, $course_id)) {
         // Message
    $_SESSION['message'] = "Course saved";
    
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Course saved']);
    } else {
        // Return failure response
        echo json_encode(['status' => 'error', 'message' => 'Course addition failed']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
