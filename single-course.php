<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once('Settings/core.php');

// Include the general function
include_once('Functions/general_function.php');

include_once('Settings/keys.php');

// check if the user is logged in
if (!logged_in()) {
    header("Location: login.php");
}

// Get the course ID
$course_id = $_GET['course_id'];

// Check if the user is enrolled in the course
$enrolled = check_enrolment($_SESSION['user_id'], $course_id);

if (!$enrolled) {
    //  Redirect to the pretest page
    header("Location: enrollment-pretest.php?course_id=$course_id&user_id=" . $_SESSION['user_id']);
}

// Get the topics for the user for a certain course
$assigned_topics = get_assigned_topics($_SESSION['user_id'], $course_id);

// Get the course name
$course_details = get_course_details($course_id);

// Get enrollment detials
$enrollment = get_enrollment($_SESSION['user_id'], $course_id);

// Get user course details
$ucourse = get_user_course($_SESSION['user_id'], $course_id);

// Get course topics
$course_topics = get_course_topics($course_id);


$i = 1;

unset($_SESSION['content']);

$subsections = get_topic_subsections_count($course_id);
$completed_subsections = get_user_subsection_status_count($course_id, $_SESSION['user_id']);

// insert course progress
$progress = ($completed_subsections / $subsections) * 100;

// insert function to update course progress
update_course_progress($progress, $_SESSION['user_id'], $course_id);

if ($progress == 100) {
    // Insert function to complete course
    complete_course($_SESSION['user_id'], $course_id);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Course: [<?php echo $course_details['course_name']; ?>]</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="assets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="assets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="assets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <!-- ion Range Slider -->
    <link type="text/css" href="assets/css/vendor-ion-rangeslider.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-ion-rangeslider.rtl.css" rel="stylesheet">

    <style>
        .loader {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        #content {
            display: none;
        }
    </style>

</head>

<body class="layout-default">
    <div class="loader loader-lg"></div>
    <!-- Header Layout -->

    <div id="content">
        <div class="mdk-header-layout js-mdk-header-layout">

            <!-- Header -->

            <?php include 'Components/header.php'; ?>

            <!-- // END Header -->
            <div>
                <p></br></br></p>
            </div>
            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">
                        <div class="container-fluid page__container mt-4 mb-4">
                            <div class="row" style="height: 400px;">
                                <div class="col-md-4">
                                    <!-- Navigation -->
                                    <div data-perfect-scrollbar style="position: relative; height:400px;">
                                        <div class="card clear-shadow border">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <strong><?php echo $course_details['course_name']; ?></strong>
                                                    <!-- add logic here -->
                                                    <button class="btn btn-light">View all Topics</button>
                                                </div>
                                                <div>
                                                    <small class="text-muted"><a href="courses.php">Back to courses</a></small>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list-group list-group-fit">
                                            <?php foreach ($assigned_topics as $topic) : ?>
                                                <?php
                                                // Get Topic details
                                                $topic_details = get_topic($topic['topic_id']);
                                                ?>
                                                <li class="list-group-item">
                                                    <div class="media">
                                                        <div class="media-left mr-1 text"><?php echo $i++; ?>.</div>
                                                        <div class="media-body">
                                                            <a class="text" href="topic.php?topic=<?php echo $topic_details['topic_name']; ?> & topic_id=<?php echo $topic['topic_id']; ?>"><?php echo $topic_details['topic_name']; ?></a>
                                                        </div>
                                                        <div class="media-right">
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        </ul>
                                    </div>
                                    <!-- // END Navigation -->
                                </div>
                                <!-- Content -->
                                <div class="col-md-8">
                                    <div id="content-area" class="mb-4" style="width: 1300px;">
                                        <!-- Initial Content -->
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header card-header-tabs-basic nav border-top" role="tablist">
                                                    <a href="#overview" class="active" data-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                                    <a href="#assets" data-toggle="tab" role="tab" aria-selected="false">Additional Materials</a>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="overview">
                                                        <div class="card-body" id="course_content" style="overflow-y: scroll; max-height: 655px;">
                                                            <?php echo $course_details['course_overview']; ?>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="assets">
                                                        <div class="card-body" id="additional_content" style="overflow-y: scroll; max-height: 655px;">
                                                            <?php
                                                            /**
                                                             * Your YouTube Data API key and other necessary configurations
                                                             */
                                                            $apiKey = $youtube_api_key;

                                                            // Initialize the session array to store video URLs if not already initialized
                                                            if (!isset($_SESSION['video_urls'])) {
                                                                $_SESSION['video_urls'] = [];
                                                            }

                                                            if (empty($_SESSION['video_urls'])) {
                                                                foreach ($course_topics as $topic) :
                                                                    $topicName = $topic['topic_name'] . ' in ' . $course_details['course_name'];
                                                                    // URL encode the topic name for use in the API request
                                                                    $query = urlencode($topicName);

                                                                    // Make the API request to get the first video related to the topic
                                                                    $apiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&q={$query}&type=video&key={$apiKey}&maxResults=1";

                                                                    // Initialize cURL session
                                                                    $ch = curl_init();
                                                                    curl_setopt($ch, CURLOPT_URL, $apiUrl);
                                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                                                                    // Fetch the data from YouTube API
                                                                    $response = curl_exec($ch);

                                                                    // Check for errors
                                                                    if ($response === false) {
                                                                        $error = curl_error($ch);
                                                                        curl_close($ch);
                                                                        echo "<div class='media-body'><a class='text-mute'>{$topicName}</a><p>Error fetching video: {$error}</p></div>";
                                                                        continue;
                                                                    }

                                                                    curl_close($ch);

                                                                    // Decode the JSON response
                                                                    $videoData = json_decode($response, true);

                                                                    // Check if we got a valid response and video data
                                                                    if (isset($videoData['items'][0])) {
                                                                        $videoId = $videoData['items'][0]['id']['videoId'];
                                                                        $videoUrl = "https://www.youtube.com/embed/{$videoId}";

                                                                        // Store the video URL in the session array
                                                                        $_SESSION['video_urls'][$topicName] = $videoUrl;
                                                                    }
                                                                endforeach;
                                                            }

                                                            // Display the video using the session variable
                                                            if (!empty($_SESSION['video_urls'])) {
                                                                foreach ($_SESSION['video_urls'] as $topicName => $videoUrl) {
                                                                    echo '<div class="media-body">';
                                                                    echo '<div class="card">';
                                                                    echo '<div class="card-body">';
                                                                    echo '<div class="embed-responsive embed-responsive-16by9">';
                                                                    echo '<iframe class="embed-responsive-item" src="' . $videoUrl . '" allowfullscreen></iframe>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- End Content -->
                            </div>
                        </div>
                        <div class="container-fluid page__container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header card-header-large bg-light d-flex align-items-center">
                                            <div class="flex">
                                                <h4 class="card-header__title">My Progress</h4>
                                                <div class="card-subtitle text-muted">Current course progress</div>
                                            </div>
                                            <div class="ml-auto">
                                                <a href="#" class="btn btn-light text-muted"><i class="material-icons icon-16pt">check_circle</i> Complete</a>
                                            </div>
                                        </div>
                                        <div class="p-2 px-4 d-flex align-items-center">
                                            <div class="progress" style="width:100%;height:6px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo ($completed_subsections/$subsections)*100; ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="ml-2 text-primary">
                                            <?php echo ($completed_subsections/$subsections)*100; ?>%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h4 class="card-header__title">Achievements</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="avatar avatar-xs mr-3" data-toggle="tooltip" data-placement="top" title="Senior Developer">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="20" height="20">
                                                        <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                            <path d="M22,3.071c0.276,0,0.5-0.224,0.5-0.5v-0.5c0-1.105-0.895-2-2-2h-17c-1.105,0-2,0.895-2,2v0.5c0,0.276,0.224,0.5,0.5,0.5H22 z M2,4.571c-0.276,0-0.5,0.224-0.5,0.5v2.265c0.006,6.758,3.638,12.994,9.513,16.334c0.613,0.345,1.362,0.345,1.975,0 c5.875-3.341,9.506-9.576,9.512-16.334V5.071c0-0.276-0.224-0.5-0.5-0.5H2z M6.64,10.093c0.063-0.165,0.223-0.274,0.4-0.272h2.737 c0.199,0,0.379-0.118,0.459-0.3l1.377-3.193c0.092-0.214,0.341-0.313,0.555-0.22c0.099,0.043,0.178,0.121,0.22,0.22l1.377,3.193 c0.08,0.182,0.26,0.3,0.459,0.3h2.742c0.233,0,0.422,0.189,0.422,0.422c0,0.12-0.051,0.235-0.141,0.315l-2.311,2.06 c-0.161,0.144-0.212,0.375-0.126,0.573l1.352,3.109c0.093,0.213-0.003,0.461-0.216,0.555c-0.122,0.054-0.262,0.046-0.378-0.02 l-3.322-1.871c-0.152-0.086-0.339-0.086-0.491,0l-3.322,1.874c-0.203,0.114-0.46,0.042-0.575-0.161 c-0.065-0.115-0.072-0.254-0.019-0.375l1.352-3.111c0.086-0.198,0.035-0.429-0.126-0.573l-2.311-2.06 C6.623,10.442,6.578,10.257,6.64,10.093z" stroke="none" fill="#ffffff" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="avatar avatar-xs mr-3" data-toggle="tooltip" data-placement="top" title="100 Lessons Learned">
                                                <span class="avatar-title rounded-circle bg-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="20" height="20">
                                                        <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                            <path d="M23.366,19.266l-2.4-4.138c-0.043-0.075-0.12-0.123-0.206-0.128c-0.086-0.003-0.168,0.039-0.216,0.111 c-1.22,1.84-3,3.239-5.077,3.989c-0.13,0.046-0.198,0.189-0.151,0.319c0.005,0.015,0.012,0.03,0.02,0.044l1.975,3.343 c0.282,0.475,0.896,0.63,1.371,0.348c0.199-0.118,0.351-0.302,0.429-0.52l0.832-2.287l2.392,0.405 c0.382,0.059,0.765-0.103,0.988-0.418C23.54,20.016,23.557,19.601,23.366,19.266z M3.471,15.09 c-0.076-0.115-0.231-0.147-0.346-0.071c-0.032,0.021-0.059,0.05-0.079,0.083l-2.412,4.165c-0.277,0.478-0.113,1.09,0.365,1.366 c0.202,0.117,0.438,0.159,0.667,0.121l2.391-0.405l0.833,2.288c0.189,0.519,0.763,0.787,1.282,0.598 c0.217-0.079,0.4-0.231,0.518-0.43l1.98-3.351c0.038-0.064,0.045-0.142,0.02-0.212c-0.025-0.07-0.08-0.125-0.15-0.15 C6.464,18.337,4.687,16.934,3.471,15.09z M12,8.206c-0.552,0-1,0.448-1,1v1c0,0.552,0.448,1,1,1s1-0.448,1-1v-1 C13,8.654,12.552,8.206,12,8.206z M18,10.206v-1c0-0.552-0.448-1-1-1s-1,0.448-1,1v1c0,0.552,0.448,1,1,1S18,10.758,18,10.206z M20.766,9.456c0-4.832-3.918-8.75-8.75-8.75s-8.75,3.918-8.75,8.75s3.918,8.75,8.75,8.75C16.846,18.2,20.76,14.286,20.766,9.456z M6,11.706c0-0.276,0.224-0.5,0.5-0.5H7v-3l-0.64,0.48c-0.221,0.166-0.534,0.121-0.7-0.1c-0.166-0.221-0.121-0.534,0.1-0.7 l0.64-0.48C6.703,7.177,7.11,7.14,7.449,7.312C7.787,7.482,8,7.828,8,8.206v3h0.5c0.276,0,0.5,0.224,0.5,0.5s-0.224,0.5-0.5,0.5h-2 C6.224,12.206,6,11.982,6,11.706z M19,10.206c0,1.105-0.895,2-2,2s-2-0.895-2-2v-1c0-1.105,0.895-2,2-2s2,0.895,2,2V10.206z M12,12.206c-1.105,0-2-0.895-2-2v-1c0-1.105,0.895-2,2-2s2,0.895,2,2v1C14,11.311,13.105,12.206,12,12.206z" stroke="none" fill="#ffffff" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="avatar avatar-xs mr-3" data-toggle="tooltip" data-placement="top" title="First Course Completed">
                                                <span class="avatar-title rounded-circle bg-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="20" height="20">
                                                        <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                            <path d="M22.593,1.394c-1.5-1.5-4.683,0.077-7.52,2.065c-0.066,0.047-0.151,0.058-0.228,0.031C10.17,1.803,5.012,4.225,3.324,8.901 c-0.719,1.994-0.712,4.177,0.021,6.166c0.028,0.076,0.017,0.161-0.029,0.228C1.464,18-0.085,21.142,1.38,22.607 c0.427,0.41,1.003,0.627,1.594,0.6c1.57,0,3.712-1.112,5.876-2.633c0.064-0.045,0.145-0.058,0.22-0.034 c4.737,1.505,9.798-1.116,11.302-5.853c0.559-1.76,0.563-3.649,0.012-5.412c-0.023-0.075-0.01-0.156,0.035-0.22 c0.436-0.615,0.83-1.214,1.175-1.79C23.328,4.375,23.655,2.454,22.593,1.394z M12.807,9.582c0,0.414-0.336,0.75-0.75,0.75 s-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75C12.471,8.833,12.806,9.168,12.807,9.582z M9.807,7.956 C8.869,7.974,7.999,7.468,7.552,6.643C7.499,6.535,7.531,6.405,7.628,6.334c1.276-0.95,2.839-1.435,4.428-1.372 c0.124,0.004,0.226,0.099,0.239,0.222c0.147,1.376-0.85,2.611-2.226,2.758C9.983,7.951,9.897,7.956,9.811,7.956H9.807z M5.807,11.582c0-0.966,0.784-1.75,1.75-1.75s1.75,0.784,1.75,1.75s-0.784,1.75-1.75,1.75S5.807,12.548,5.807,11.582z M5.559,18.441c0.083,0.081,0.212,0.093,0.309,0.03c2.516-1.677,4.851-3.611,6.967-5.771c2.053-2.017,3.905-4.227,5.533-6.6 c0.065-0.097,0.054-0.225-0.026-0.31c-0.335-0.356-0.697-0.683-1.085-0.98c-0.11-0.085-0.129-0.243-0.044-0.352 c0.018-0.023,0.039-0.042,0.063-0.058c0.875-0.574,1.811-1.052,2.79-1.423c0.286-0.11,0.585-0.181,0.89-0.211 C21.092,2.76,21.208,2.864,21.217,3c0.076,1.206-2.163,5.469-7.462,10.768s-9.544,7.524-10.729,7.5 c-0.135-0.004-0.243-0.114-0.244-0.249c0.024-0.363,0.107-0.72,0.245-1.056c0.334-0.86,0.753-1.685,1.249-2.463 c0.072-0.118,0.226-0.154,0.344-0.082c0.025,0.016,0.048,0.036,0.066,0.059C4.953,17.819,5.245,18.141,5.559,18.441z" stroke="none" fill="#ffffff" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="avatar avatar-xs mr-3" data-toggle="tooltip" data-placement="top" title="1 Series Completed">
                                                <span class="avatar-title rounded-circle bg-light-gray">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="20" height="20">
                                                        <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                            <path d="M5,11h14c1.105,0,2-0.895,2-2V7c0-0.552-0.448-1-1-1h-1c-0.276,0-0.5,0.224-0.5,0.5V7c0,0.552-0.448,1-1,1s-1-0.448-1-1 V6.5C16.5,6.224,16.276,6,16,6h-2c-0.276,0-0.5,0.224-0.5,0.5c0.001,0.323-0.105,0.636-0.3,0.893 c-0.084,0.11-0.24,0.131-0.35,0.048c-0.062-0.047-0.099-0.121-0.099-0.199V4.5c0-0.276,0.224-0.5,0.5-0.5h3.5 c0.276,0,0.5-0.223,0.501-0.499c0-0.133-0.053-0.261-0.147-0.355l-0.793-0.792c-0.196-0.195-0.196-0.512-0.001-0.707 c0,0,0.001-0.001,0.001-0.001L17.1,0.854c0.196-0.195,0.196-0.512,0.001-0.707C17.008,0.054,16.882,0.001,16.75,0h-4.5 c-0.552,0-1,0.448-1,1v6.242c0,0.138-0.112,0.25-0.25,0.25c-0.078,0-0.151-0.037-0.199-0.099c-0.195-0.257-0.301-0.57-0.3-0.893 c0-0.276-0.224-0.5-0.5-0.5C10.001,6,10,6,10,6H8C7.724,6,7.5,6.224,7.5,6.5V7c0,0.552-0.448,1-1,1s-1-0.448-1-1V6.5 C5.5,6.224,5.276,6,5,6H4C3.448,6,3,6.448,3,7v2C3,10.105,3.895,11,5,11z M23,22h-2.735c-0.287-0.01-0.531-0.211-0.595-0.491 l-1.679-8.592c-0.045-0.236-0.251-0.407-0.491-0.407h-11c-0.24,0-0.446,0.171-0.491,0.407L4.33,21.509 C4.266,21.791,4.019,21.993,3.73,22H1c-0.552,0-1,0.448-1,1s0.448,1,1,1h8.5c0.276,0,0.5-0.224,0.5-0.5v-3c0-1.105,0.895-2,2-2 s2,0.895,2,2v3c0,0.276,0.224,0.5,0.5,0.5H23c0.552,0,1-0.448,1-1S23.552,22,23,22z M13,16c0,0.552-0.448,1-1,1s-1-0.448-1-1v-1 c0-0.552,0.448-1,1-1s1,0.448,1,1V16z" stroke="none" fill="#ffffff" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="avatar avatar-xs mr-3" data-toggle="tooltip" data-placement="top" title="VIP Pass">
                                                <span class="avatar-title rounded-circle bg-light-gray">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="20" height="20">
                                                        <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                            <path d="M23,9c0.552,0,1-0.448,1-1V5.5C24,4.119,22.881,3,21.5,3h-19C1.119,3,0,4.119,0,5.5V8c0,0.552,0.448,1,1,1 c1.657,0,3,1.343,3,3s-1.343,3-3,3c-0.552,0-1,0.448-1,1v2.5C0,19.881,1.119,21,2.5,21h19c1.381,0,2.5-1.119,2.5-2.5V16 c0-0.552-0.448-1-1-1c-1.657,0-3-1.343-3-3S21.343,9,23,9z M12,5c0.552,0,1,0.448,1,1s-0.448,1-1,1s-1-0.448-1-1S11.448,5,12,5z M6,19c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S6.552,19,6,19z M6,7C5.448,7,5,6.552,5,6s0.448-1,1-1s1,0.448,1,1 S6.552,7,6,7z M12,19c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S12.552,19,12,19z M15.21,11.565l-1.349,1.09 c-0.084,0.067-0.115,0.181-0.077,0.282l0.656,1.749c0.097,0.259-0.034,0.547-0.293,0.644c-0.156,0.058-0.33,0.036-0.465-0.061 l-1.542-1.1c-0.087-0.062-0.203-0.062-0.29,0l-1.541,1.1c-0.225,0.161-0.537,0.109-0.698-0.116c-0.097-0.135-0.12-0.31-0.061-0.466 l0.656-1.749c0.038-0.101,0.007-0.215-0.077-0.282L8.78,11.565c-0.215-0.173-0.248-0.488-0.075-0.703 c0.095-0.118,0.238-0.186,0.389-0.186h1.441c0.1,0,0.191-0.06,0.23-0.153l0.773-1.832c0.107-0.255,0.4-0.374,0.655-0.267 c0.121,0.051,0.217,0.147,0.267,0.267l0.765,1.831c0.039,0.093,0.13,0.153,0.231,0.153H14.9c0.276,0,0.5,0.224,0.5,0.5 c0,0.151-0.068,0.294-0.186,0.389L15.21,11.565z M18,19c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.552,19,18,19z M18,7 c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.552,7,18,7z" stroke="none" fill="#ffffff" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- // END drawer-layout__content -->

                    <!-- Sidebar -->
                    <?php include 'Components/sidebar.php'; ?>
                </div>

            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->
    </div>

    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default" :layout-location="{
      'default': 'student-take-course.html',
      'fixed': 'fixed-student-take-course.html',
      'fluid': 'fluid-student-take-course.html',
      'mini': 'mini-student-take-course.html'
    }"></app-settings>
    </div>

    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- Range Slider -->
    <script src="assets/vendor/ion.rangeSlider.min.js"></script>
    <script src="assets/js/ion-rangeslider.js"></script>

    <!-- App -->
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/sidebar-mini.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>


    <script>
        $(document).ready(function() {
            $('.loader').hide();
            $('#content').show();
        });
    </script>

</body>




</html>