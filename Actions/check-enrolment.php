<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__ . "/../Functions/general_function.php");

// Include the core.php file
include_once(__DIR__ . "/../Settings/core.php");

// Get the form data
$course_id = $_POST['course_id'];
$student_id = $_POST['student_id'];
$course_name = $_POST['course_name'];

// Call function to check if the student is enrolled in the course
if (check_enrolment($student_id, $course_id)) {
    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Enrolled', 'course_id' => $course_id, 'student_id' => $student_id, 'course_name' => $course_name]);
} else {
    // Return success response with 'Not enrolled' message
    echo json_encode(['status' => 'success', 'message' => 'Not enrolled', 'course_id' => $course_id, 'student_id' => $student_id, 'course_name' => $course_name]);
}
?>
