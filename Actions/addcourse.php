<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection
include_once(__DIR__ . '/../Settings/core.php');

// Include the general functions
include_once(__DIR__ . '/../Functions/general_function.php');

// Initialize response array
$response = [
    'success' => false,
    'error' => ''
];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $courseName = $_POST['courseName'];
    $courseDescription = $_POST['courseDescription'];
    $courseOverview = $_POST['courseOverview'];
    $topics = $_POST['topics'];
    $subtopics = $_POST['subtopics'];

    // Validate inputs
    if (empty($courseName) || empty($courseDescription) || empty($courseOverview) || empty($topics)) {
        $response['error'] = 'All fields are required.';
    } else {
        // Insert course into the database
        $courseId = add_course_admin($courseName, $courseDescription, $courseOverview);
        
        if ($courseId) {
            // Insert topics and subtopics
            foreach ($topics as $index => $topicName) {
                $topicId = add_topic_admin($courseId, $topicName);
                if ($topicId) {
                    foreach ($subtopics[$index] as $subtopicName) {
                        $subtopic = add_subtopic_admin($topicId, $subtopicName);
                        if ($subtopic) {
                            // Call API to generate the topic content
                            $apiResponse = call_api_to_generate_content($topicId, $subtopicName);
                            if (!$apiResponse['success']) {
                                $response['error'] = 'Failed to generate content for subtopic.';
                                break 2; // Break out of both foreach loops
                            }
                        } else {
                            $response['error'] = 'Failed to add subtopic.';
                            break 2; // Break out of both foreach loops
                        }
                    }
                } else {
                    $response['error'] = 'Failed to add topic.';
                    break; // Break out of the topics foreach loop
                }
            }

            if (empty($response['error'])) {
                $response['success'] = true;
                // Redirect to the previous page
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $response['error'] = 'Failed to add course.';
        }
    }
} else {
    $response['error'] = 'Invalid request method.';
}

// If there are errors, display the error message
if (!$response['success']) {
    $_SESSION['error'] = $response['error'];
    echo $response['error'];
    exit();
}

/**
 * Call API to generate content for the given topic and subtopic.
 *
 * @param int $topicId
 * @param string $subtopicName
 * @return array
 */
function call_api_to_generate_content($topicId, $subtopicName) {
    // Example API call logic
    $apiUrl = 'https://example.com/generate-content';
    $postData = [
        'topicId' => $topicId,
        'subtopicName' => $subtopicName
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>
