<?php
// Report the errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the core file
include_once(__DIR__ . "/Settings/core.php");

// Include the general functions
include_once(__DIR__ . "/Functions/general_function.php");

// If user is not logged in, redirect to the login page
if (!logged_in()) {
    header("Location: login.php");
}

// Get user courses
$u_courses = get_user_courses($_SESSION['user_id']);

// Get user details
$u_details = get_user_details($_SESSION['user_id']);

// Get user saved couses
$u_saved_courses = get_user_saved_courses($_SESSION['user_id']);

// Get all topics
$topics = get_all_topics();

unset($_SESSION['content']);

$no_quiz = get_user_quizzes($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

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


</head>

<body class="layout-default">
    <!-- Header Layout -->
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
                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <h1 class="m-lg-0">My Dashboard</h1>
                            <div>
                                <a href="edit-account.php" class="btn btn-light ml-3"><i class="material-icons">edit</i> Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid page__container">

                        <h4 class="card-header__title mb-3">Saved Courses</h4>
                        <?php if (!$u_saved_courses) : ?>
                            <!-- Content for My Courses tab -->
                            <p>You have not saved any courses yet. You can view the <a href="courses.php">courses page</a>.</p>
                        <?php else : ?>

                            <div class="row card-group-row">
                                <?php foreach ($u_saved_courses as $course) {
                                    $course_id = $course;
                                    // Get course details
                                    $course_details = get_course_details($course_id);
                                    $course_title = $course_details['course_name'];
                                    $course_progress = 0; //change this
                                    $course_description = $course_details['course_description'];
                                    $course_link = "single-course.php?course_id=" . $course_details['course_id'] . "&coursename=" . $course_details['course_name'];
                                ?>
                                    <div class="col-lg-3 col-md-4 card-group-row__col">
                                        <div class="card card-group-row__card ">
                                            <div class="card-body d-flex flex-column">
                                                <div class="avatar mb-2">
                                                    <span class="bg-soft-<?php if ($course_details['status'] == 'available') : ?>primary <?php else : ?>secondary<?php endif; ?> avatar-title rounded-circle text-center text-<?php if ($course_details['status'] == "available") : ?>primary <?php else : ?>secondary<?php endif; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="30" height="30">
                                                            <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                                <path d="M11.75,4.5C11.888,4.5,12,4.612,12,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75c0-0.138,0.112-0.25,0.25-0.25h1 c0.138,0,0.25,0.112,0.25,0.25v4.7c0,0.135,0.11,0.245,0.246,0.244c0.018,0,0.036-0.002,0.054-0.006 c0.48-0.108,0.969-0.171,1.46-0.188c0.133-0.002,0.239-0.11,0.24-0.243V4.5c0-1.105-0.895-2-2-2h-1.25C14.112,2.5,14,2.388,14,2.25 V1c0-0.552-0.448-1-1-1s-1,0.448-1,1v1.25c0,0.138-0.112,0.25-0.25,0.25h-1.5C10.112,2.5,10,2.388,10,2.25V1c0-0.552-0.448-1-1-1 S8,0.448,8,1v1.25C8,2.388,7.888,2.5,7.75,2.5h-1.5C6.112,2.5,6,2.388,6,2.25V1c0-0.552-0.448-1-1-1S4,0.448,4,1v1.25 C4,2.388,3.888,2.5,3.75,2.5H2c-1.105,0-2,0.895-2,2v13c0,1.105,0.895,2,2,2h7.453c0.135,0,0.244-0.109,0.245-0.243 c0-0.019-0.002-0.038-0.007-0.057c-0.109-0.48-0.173-0.968-0.191-1.46c-0.002-0.133-0.11-0.239-0.243-0.24H2.25 C2.112,17.5,2,17.388,2,17.25V4.75C2,4.612,2.112,4.5,2.25,4.5h1.5C3.888,4.5,4,4.612,4,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1 V4.75C6,4.612,6.112,4.5,6.25,4.5h1.5C7.888,4.5,8,4.612,8,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75 c0-0.138,0.112-0.25,0.25-0.25H11.75z M17.5,11c-3.59,0-6.5,2.91-6.5,6.5s2.91,6.5,6.5,6.5s6.5-2.91,6.5-6.5 C23.996,13.912,21.088,11.004,17.5,11z M17.5,22.5c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.052,22.5,17.5,22.5z M18.439,18.327c-0.118,0.037-0.196,0.15-0.189,0.273v0.15c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75V18.2 c0.003-0.588,0.413-1.096,0.988-1.222c0.607-0.131,0.993-0.73,0.862-1.338c-0.131-0.607-0.73-0.993-1.338-0.862 c-0.517,0.112-0.887,0.57-0.887,1.099c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75c0-1.45,1.176-2.625,2.626-2.624 c1.45,0,2.625,1.176,2.624,2.626c0,1.087-0.671,2.062-1.686,2.451V18.327z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <a href="<?php
                                                            if ($course_details['status'] == 'available') :
                                                                echo $course_link;
                                                            else :
                                                                echo "Actions/not_activated.php";
                                                            endif; ?>" class="text-dark mb-2">
                                                    <strong><?php echo $course_title; ?></strong>
                                                </a>
                                                <p class="text-muted"><?php if ($course_details['status'] == "available") : echo $course_description;
                                                                        else : echo "Content coming soon";
                                                                        endif; ?></p>

                                                <div class="d-flex justify-content-between align-items-center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endif; ?>


                        <div class="row">
                            <div class="col-lg-6">

                                <div class="card">
                                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                                        <div class="flex">
                                            <h4 class="card-header__title">In Progress</h4>
                                            <div class="card-subtitle text-muted">Recent Courses</div>
                                        </div>
                                        <div class="ml-auto">
                                            <a href="student-courses.html" class="btn btn-light">Browse All</a>
                                        </div>
                                    </div>

                                    <?php if (!$u_courses) : ?>
                                        <!-- Content for My Courses tab -->
                                        <p style="text-align: center;">You have not started any courses yet. You can view the <a href="courses.php">courses page</a>.</p>
                                    <?php else : ?>

                                        <ul class="list-group list-group-flush mb-0" style="z-index: initial;">
                                            <?php foreach ($u_courses as $pcourse) {
                                                $course_id = $pcourse['course_id'];
                                                // Get course details
                                                $pcourse_details = get_course_details($course_id);
                                                $pcourse_title = $pcourse_details['course_name'];
                                                $pcourse_progress = $pcourse['progress'] ?? 0;
                                                $pcourse_link = "single-course.php?course_id=" . $pcourse_details['course_id'] . "&coursename=" . $pcourse_details['course_name'];

                                                // get number of subsections
                                                $subsections = get_topic_subsections_count($course_id);
                                                $completed_subsections = get_user_subsection_status_count($course_id, $_SESSION['user_id']);
                                            ?>
                                                <li class="list-group-item" style="z-index: initial;">
                                                    <div class="d-flex align-items-center">
                                                        <a href="<?php echo $pcourse_link; ?>" class="mr-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="30" height="30">
                                                                <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                                    <path d="M11.75,4.5C11.888,4.5,12,4.612,12,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75c0-0.138,0.112-0.25,0.25-0.25h1 c0.138,0,0.25,0.112,0.25,0.25v4.7c0,0.135,0.11,0.245,0.246,0.244c0.018,0,0.036-0.002,0.054-0.006 c0.48-0.108,0.969-0.171,1.46-0.188c0.133-0.002,0.239-0.11,0.24-0.243V4.5c0-1.105-0.895-2-2-2h-1.25C14.112,2.5,14,2.388,14,2.25 V1c0-0.552-0.448-1-1-1s-1,0.448-1,1v1.25c0,0.138-0.112,0.25-0.25,0.25h-1.5C10.112,2.5,10,2.388,10,2.25V1c0-0.552-0.448-1-1-1 S8,0.448,8,1v1.25C8,2.388,7.888,2.5,7.75,2.5h-1.5C6.112,2.5,6,2.388,6,2.25V1c0-0.552-0.448-1-1-1S4,0.448,4,1v1.25 C4,2.388,3.888,2.5,3.75,2.5H2c-1.105,0-2,0.895-2,2v13c0,1.105,0.895,2,2,2h7.453c0.135,0,0.244-0.109,0.245-0.243 c0-0.019-0.002-0.038-0.007-0.057c-0.109-0.48-0.173-0.968-0.191-1.46c-0.002-0.133-0.11-0.239-0.243-0.24H2.25 C2.112,17.5,2,17.388,2,17.25V4.75C2,4.612,2.112,4.5,2.25,4.5h1.5C3.888,4.5,4,4.612,4,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1 V4.75C6,4.612,6.112,4.5,6.25,4.5h1.5C7.888,4.5,8,4.612,8,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75 c0-0.138,0.112-0.25,0.25-0.25H11.75z M17.5,11c-3.59,0-6.5,2.91-6.5,6.5s2.91,6.5,6.5,6.5s6.5-2.91,6.5-6.5 C23.996,13.912,21.088,11.004,17.5,11z M17.5,22.5c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.052,22.5,17.5,22.5z M18.439,18.327c-0.118,0.037-0.196,0.15-0.189,0.273v0.15c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75V18.2 c0.003-0.588,0.413-1.096,0.988-1.222c0.607-0.131,0.993-0.73,0.862-1.338c-0.131-0.607-0.73-0.993-1.338-0.862 c-0.517,0.112-0.887,0.57-0.887,1.099c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75c0-1.45,1.176-2.625,2.626-2.624 c1.45,0,2.625,1.176,2.624,2.626c0,1.087-0.671,2.062-1.686,2.451V18.327z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </g>
                                                            </svg>

                                                        </a>
                                                        <div class="flex">
                                                            <a href="<?php echo $pcourse_link; ?>" class="text-body"><strong><?php echo $pcourse_title; ?></strong></a>
                                                            <div class="d-flex align-items-center">
                                                                <div class="progress" style="width: 100px; height:4px;">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo ($completed_subsections/$subsections)*100; ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small class="text-muted ml-2"><?php echo ($completed_subsections/$subsections)*100; ?>%</small>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown ml-3">
                                                            <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#">View Stats</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>


                                <div class="card">
                                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                                        <div class="flex">
                                            <h4 class="card-header__title">My Quizes</h4>
                                            <div class="card-subtitle text-muted">Best Scores</div>
                                        </div>
                                        <div class="dropdown ml-auto">
                                            <a class="btn btn-sm btn-light" href="#">View all</a>
                                        </div>
                                    </div>



                                    <ul class="list-group list-group-flush mb-0">
                                        <!-- if there are not quizzes -->
                                        <?php if (!$no_quiz) : ?>
                                            <p style="text-align: center;">You have not taken any quizzes yet. You can view the <a href="courses.php">courses page</a>.</p>
                                        <?php else : ?>
                                            <?php foreach ($topics as $qtopic) :
                                                // Call the function to get the user quiz results
                                                $quizzes = get_user_best_result($_SESSION['user_id'], $qtopic['course_id'], $qtopic['topic_id']);

                                                $course_name = get_topic_course_details($qtopic['topic_id'])['course_name']; ?>

                                                <!-- if the topic has not entry, for the score dont display the topic -->
                                                <?php if (!empty($quizzes['topic_id']) && isset($quizzes['score'])) : ?>
                                                    <li class=" list-group-item">
                                                        <div class="media align-items-center">
                                                            <div class="media-left text-light-gray mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="30" height="30">
                                                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                                        <path d="M11.75,4.5C11.888,4.5,12,4.612,12,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75c0-0.138,0.112-0.25,0.25-0.25h1 c0.138,0,0.25,0.112,0.25,0.25v4.7c0,0.135,0.11,0.245,0.246,0.244c0.018,0,0.036-0.002,0.054-0.006 c0.48-0.108,0.969-0.171,1.46-0.188c0.133-0.002,0.239-0.11,0.24-0.243V4.5c0-1.105-0.895-2-2-2h-1.25C14.112,2.5,14,2.388,14,2.25 V1c0-0.552-0.448-1-1-1s-1,0.448-1,1v1.25c0,0.138-0.112,0.25-0.25,0.25h-1.5C10.112,2.5,10,2.388,10,2.25V1c0-0.552-0.448-1-1-1 S8,0.448,8,1v1.25C8,2.388,7.888,2.5,7.75,2.5h-1.5C6.112,2.5,6,2.388,6,2.25V1c0-0.552-0.448-1-1-1S4,0.448,4,1v1.25 C4,2.388,3.888,2.5,3.75,2.5H2c-1.105,0-2,0.895-2,2v13c0,1.105,0.895,2,2,2h7.453c0.135,0,0.244-0.109,0.245-0.243 c0-0.019-0.002-0.038-0.007-0.057c-0.109-0.48-0.173-0.968-0.191-1.46c-0.002-0.133-0.11-0.239-0.243-0.24H2.25 C2.112,17.5,2,17.388,2,17.25V4.75C2,4.612,2.112,4.5,2.25,4.5h1.5C3.888,4.5,4,4.612,4,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1 V4.75C6,4.612,6.112,4.5,6.25,4.5h1.5C7.888,4.5,8,4.612,8,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75 c0-0.138,0.112-0.25,0.25-0.25H11.75z M17.5,11c-3.59,0-6.5,2.91-6.5,6.5s2.91,6.5,6.5,6.5s6.5-2.91,6.5-6.5 C23.996,13.912,21.088,11.004,17.5,11z M17.5,22.5c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.052,22.5,17.5,22.5z M18.439,18.327c-0.118,0.037-0.196,0.15-0.189,0.273v0.15c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75V18.2 c0.003-0.588,0.413-1.096,0.988-1.222c0.607-0.131,0.993-0.73,0.862-1.338c-0.131-0.607-0.73-0.993-1.338-0.862 c-0.517,0.112-0.887,0.57-0.887,1.099c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75c0-1.45,1.176-2.625,2.626-2.624 c1.45,0,2.625,1.176,2.624,2.626c0,1.087-0.671,2.062-1.686,2.451V18.327z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="media-body">
                                                                <a class="text-body mb-1" href="quiz-page.php?topic_name=<?php echo $qtopic['topic_name']; ?> & topic_id=<?php echo $qtopic['topic_id']; ?>"><strong><?php echo $qtopic['topic_name']; ?></strong></a><br>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="text-blue mr-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="16" height="16" style="position:relative; top:-2px">
                                                                            <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                                                <path d="M2.5,16C2.224,16,2,15.776,2,15.5v-11C2,4.224,2.224,4,2.5,4h14.625c0.276,0,0.5,0.224,0.5,0.5V8c0,0.552,0.448,1,1,1 s1-0.448,1-1V4c0-1.105-0.895-2-2-2H2C0.895,2,0,2.895,0,4v12c0,1.105,0.895,2,2,2h5.375c0.138,0,0.25,0.112,0.25,0.25v1.5 c0,0.138-0.112,0.25-0.25,0.25H5c-0.552,0-1,0.448-1,1s0.448,1,1,1h7.625c0.552,0,1-0.448,1-1s-0.448-1-1-1h-2.75 c-0.138,0-0.25-0.112-0.25-0.25v-1.524c0-0.119,0.084-0.221,0.2-0.245c0.541-0.11,0.891-0.638,0.781-1.179 c-0.095-0.466-0.505-0.801-0.981-0.801L2.5,16z M3.47,9.971c-0.303,0.282-0.32,0.757-0.037,1.06c0.282,0.303,0.757,0.32,1.06,0.037 c0.013-0.012,0.025-0.025,0.037-0.037l2-2c0.293-0.292,0.293-0.767,0.001-1.059c0,0-0.001-0.001-0.001-0.001l-2-2 c-0.282-0.303-0.757-0.32-1.06-0.037s-0.32,0.757-0.037,1.06C3.445,7.006,3.457,7.019,3.47,7.031l1.293,1.293 c0.097,0.098,0.097,0.256,0,0.354L3.47,9.971z M7,11.751h2.125c0.414,0,0.75-0.336,0.75-0.75s-0.336-0.75-0.75-0.75H7 c-0.414,0-0.75,0.336-0.75,0.75S6.586,11.751,7,11.751z M18.25,16.5c0,0.276-0.224,0.5-0.5,0.5s-0.5-0.224-0.5-0.5v-5.226 c0-0.174-0.091-0.335-0.239-0.426c-1.282-0.702-2.716-1.08-4.177-1.1c-0.662-0.029-1.223,0.484-1.252,1.146 c-0.001,0.018-0.001,0.036-0.001,0.054v7.279c0,0.646,0.511,1.176,1.156,1.2c1.647-0.011,3.246,0.552,4.523,1.593 c0.14,0.14,0.33,0.219,0.528,0.218c0.198,0.001,0.388-0.076,0.529-0.215c1.277-1.044,2.878-1.61,4.527-1.6 c0.641-0.023,1.15-0.547,1.156-1.188v-7.279c-0.001-0.327-0.134-0.64-0.369-0.867c-0.236-0.231-0.557-0.353-0.886-0.337 c-1.496,0.016-2.963,0.411-4.265,1.148c-0.143,0.092-0.23,0.251-0.23,0.421V16.5z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </g>
                                                                        </svg>
                                                                    </span>
                                                                    <a href="single-course.php?course_id=<?php echo $qtopic['course_id']; ?>&coursename=<?php echo $course_name; ?>" class="small"><?php echo $course_name; ?></a>
                                                                </div>
                                                            </div>
                                                            <div class="media-right text-center d-flex align-items-center">
                                                                <?php
                                                                // get the number of questions for that topic
                                                                $questions = get_questions_count($qtopic['topic_id']);?>
                                                                <span class="badge badge-<?php if (($quizzes['score'] / $questions) >= 80) :
                                                                                                echo "success";
                                                                                            elseif (($quizzes['score'] / $questions) >= 50) :
                                                                                                echo "warning";
                                                                                            else :
                                                                                                echo "danger";
                                                                                            endif; ?> mr-2">
                                                                    <?php if (($quizzes['score'] / $questions) >= 80) :
                                                                        echo "Excellent";
                                                                    elseif (($quizzes['score'] / $questions) >= 50) :
                                                                        echo "Needs a little more work";
                                                                    else :
                                                                        echo "We definitely need to work on this";
                                                                    endif; ?>
                                                                </span>
                                                                <h4 class="mb-0 text-<?php if (($quizzes['score'] / $questions) >= 80) :
                                                                                            echo "success";
                                                                                        elseif (($quizzes['score'] / $questions) >= 50) :
                                                                                            echo "warning";
                                                                                        else :
                                                                                            echo "danger";
                                                                                        endif; ?>"><?php echo $quizzes['score']; ?>/<?php echo $questions; ?></h4>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // END drawer-layout__content -->

                <!-- Side Bar -->
                <?php include 'Components/sidebar.php'; ?>

            </div>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->

    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default" :layout-location="{
      'default': 'student-dashboard.html',
      'fixed': 'fixed-student-dashboard.html',
      'fluid': 'fluid-student-dashboard.html',
      'mini': 'mini-student-dashboard.html'
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if (!empty($_SESSION['message']) and $_SESSION['message'] == "Login") {
        //sweet alert
        echo '
    
<script type="text/javascript">

$(document).ready(function(){

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: "You have successfully logged in."
      });
});

</script>
';
        // unset the session variable
        unset($_SESSION['message']);
    } elseif (!empty($_SESSION['message']) and $_SESSION['message'] == "Not Activated") {
        //sweet alert
        echo '
        <script type="text/javascript">

$(document).ready(function(){

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "danger",
        title: "The course is not yet activated."
      });
});

</script>
';
        // unset the session variable
        unset($_SESSION['message']);
    }
    ?>


</body>

</html>