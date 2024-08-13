<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core files
include_once(__DIR__ . "/../Functions/general_function.php");
include_once(__DIR__ . "/../Settings/core.php");

$answers = [];
$questions = [];

// get the learning styles
$learning_styles = get_learning_styles();

// Main logic to handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];

    // Iterate over the form responses
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'answer-') === 0) {
            $question_index = str_replace('answer-', '', $key);
            $question_id = $question_index; // Adjust according to your question ID scheme
            $answer_text = $value;

            // Find the corresponding question text based on question_id
            $question_text = get_question_by_id($question_id);

            // Push the answer to the answers array
            $answers[] = $answer_text;
            $questions[] = $question_text;
        }
    }

    // Based on the questions and the answers, determine the learning style using your custom API
    $learning_style = determine_learning_style($questions, $answers, $learning_styles);

    echo $learning_style;

    // Insert the learning style into the database
    if (insert_learning_style($user_id, $learning_style)) {
        $_SESSION['learning_style'] = $learning_style;

        header("Location: ../index.php");
        exit;
    } else {
        echo "Failed to insert learning style";
    }
}

// Function to determine the learning style using your custom API
function determine_learning_style($questions, $answers, $learning_styles) {
    // Construct the prompt
    $prompt = "Based on the following questions and answers, determine the learning style:\n";
    foreach ($questions as $index => $question) {
        $prompt .= "Q: " . $question . "\nA: " . $answers[$index] . "\n";
    }
    $prompt .= "Possible learning styles are:\n";
    foreach ($learning_styles as $index => $style) {
        $prompt .= "- " . $style['style_name'] . "\n";
    }

    // Call the custom API
    $response = custom_api_request($prompt);

    // Extract the learning style from the response
    $learning_style = extract_learning_style_from_response($response, $learning_styles);

    return $learning_style;
}

// Function to call the custom API
function custom_api_request($prompt) {
    $url = 'https://dela-xw5ne3ehqq-uc.a.run.app/chat?Content-Type=application/json';
    $data = [
        'query' => $prompt
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        return null;
    }

    return $result;
}

// Function to extract the learning style from the API response
function extract_learning_style_from_response($response, $learning_styles) {
    if (!$response || !isset($response)) {
        return 'no response';
    }

    $output = $response;
    foreach ($learning_styles as $index =>$style) {
        if (stripos($output, $style['style_name']) !== false) {
            return $style['style_name'];
        }
    }
    return 'Unknown';
}

?>
