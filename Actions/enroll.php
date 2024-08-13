<?php
// Report all errors

use FontLib\Table\Type\head;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the core file
include_once(__DIR__ . "/../Settings/core.php");

// Include the general function
include_once(__DIR__ . "/../Functions/general_function.php");

// Get course ID
$course_id = $_POST['course_id'];


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user ID and other necessary information
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 'Unknown User';

    // Group questions and answers by topic
    $questions_by_topic = [];

    // Loop through the POST data to group questions and answers by topic
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question-') === 0) {
            $index = str_replace('question-', '', $key);
            $question = $value;
            $answer = isset($_POST['answer-' . $index]) ? $_POST['answer-' . $index] : 'No answer';
            $topic_id = isset($_POST['topic_id-' . $index]) ? $_POST['topic_id-' . $index] : 'Unknown Topic';

            // Store the question and answer in the corresponding topic group
            if (!isset($questions_by_topic[$topic_id])) {
                $questions_by_topic[$topic_id] = [];
            }
            $questions_by_topic[$topic_id][] = [
                'question_id' => $index + 1,
                'question' => $question,
                'answer' => $answer
            ];
        }
    }

    $response = ['status' => 'success', 'message' => 'Based on your answers, we have created a list of topics that you should study.', 'topics' => []];

    // Display the grouped questions and answers by topic
    foreach ($questions_by_topic as $topic_id => $questions) {
        $correct_answers = 0;
        foreach ($questions as $q) {
            // Check if the answer is correct using the pre-defined check_answer function
            $correct = check_answer($q['question_id'], $q['answer']);
            if ($correct) {
                $correct_answers++;
            }
        }

        // Check if student is enrolled in the course
        $enrolled = check_enrolment($user_id, $course_id);

        if (!$enrolled) {
            // Enroll the student in the course
            $enrolled = student_enrolment($user_id, $course_id);
        }

        // If the user has already been assigned the subtopic, do not assign it again
        // get all the subtopics for a topic
        $subtopics = get_subtopics($topic_id);

        // Loop through the subtopics
        foreach ($subtopics as $subtopic) {
            // Get the subtopic ID
            $subtopic_id = $subtopic['subtopic_id'];

            // Check if the user has already been assigned the subtopic
            $assigned = check_assignment($user_id, $subtopic_id, $course_id);

            if (!$assigned) {
                // Assign the subtopic to the student
                assign_topic($user_id, $topic_id, $course_id, $subtopic_id);
                $response['topics'][] = $topic_id;
            }
        }
    }

    // Redirect to the course page
    header('Location: ../single-course.php?course_id=' . $course_id . '&course_name=' . get_course_details($course_id)['course_name']);

}
?>