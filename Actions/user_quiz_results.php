<?php
// report errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__ . "/../Functions/general_function.php");

// Include the core.php file
include_once(__DIR__ . "/../Settings/core.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = $_POST['answer'];
    $question_ids = $_POST['question_id'];

    // Get the topic ID
    $topic_id = $_POST['topic_id'];

    // Get the user ID
    $user_id = $_POST['user_id'];

    // Get the course ID
    $course_id = $_POST['course_id'];

    // Call function to get the score

    // Call the function to add the quiz results
    if (add_quiz_results($user_id, $topic_id)) {

        // Call the function to get the most recent quiz ID
        $quiz_id = get_most_recent_quiz_id($user_id, $topic_id);

        // Get the status for each questions, correct or wrong
        $marks = get_quiz_mark($question_ids, $answers);

        // Call function to add the quiz answers
        if (add_quiz_answers($quiz_id, $question_ids, $answers, $marks, $user_id, $course_id, $topic_id)) {
            echo "Quiz results added successfully";
            // Message
            $_SESSION['message'] = "Quiz Completed";
            
            unset($_SESSION['new_quiz_attempt']);

            // navigate to previous page
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Quiz results addition failed";
        }
    } else {
        echo "Quiz results addition failed";
    }


   
}
?>