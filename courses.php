<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once(__DIR__ . "/Settings/core.php");

// Include the general functions
include_once(__DIR__ . "/Functions/general_function.php");

if (!logged_in()) {
    header("Location: login.php");
}

// Get all courses
$courses = get_all_courses();

// Count the number of courses
$course_count = count_courses();

// Geut user courses
$u_courses = get_user_courses($_SESSION['user_id']);

// Get user saved couses
$u_saved_courses = get_user_saved_courses($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Courses</title>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- script to my ajax js file -->
    <script src="assets/js/ajax.js"></script>



</head>

<body class="layout-default">
    <div id="content-area">

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
                            <div class="page__heading d-flex align-items-center justify-content-between">
                                <h1 class="m-0">Courses</h1>
                            </div>
                        </div>

                        <div class="container-fluid page__container">
                            <form action="#" class="">
                                <div class="d-lg-flex">
                                    <div class="search-form mb-3 mr-3-lg search-form--light">
                                        <input type="text" class="form-control" placeholder="Search courses" id="searchSample02">
                                        <button class="btn" type="button"><i class="material-icons">search</i></button>
                                    </div>

                                    <div class="form-inline  mb-3 ml-auto">
                                        <div class="form-group">
                                            <label for="published01" class="form-label mr-1">Filter</label>
                                            <select id="published01" class="form-control custom-select" style="width: 200px;">
                                                <option selected>All</option>
                                                <option value="1">Available</option>
                                                <option value="3">Coming Soon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <?php foreach ($courses as $course) : ?>
                                    <div class="col-md-3">
                                        <div class="card card__course">
                                            <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                                <style>
                                                    .custom-submit-button {
                                                        border: none;
                                                        background: none;
                                                        padding: 0;
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        width: 100%;
                                                    }

                                                    .course__title {
                                                        text-align: center;
                                                    }

                                                    .custom-form-wrapper {
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        width: 100%;
                                                    }
                                                </style>

                                                <div class="custom-form-wrapper">
                                                    <form method="POST" action="Actions/check-enrolment.php" id="enrollmentForm">
                                                        <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
                                                        <input type="hidden" name="student_id" value="<?php echo $_SESSION['user_id']; ?>">
                                                        <input type="hidden" name="course_name" value="<?php echo $course['course_name']; ?>">
                                                        <button class="card-header__title custom-submit-button" type="submit">
                                                            <span class="course__title"><?php echo $course['course_name']; ?></span>
                                                        </button>
                                                    </form>
                                                </div>


                                            </div>

                                            <div class="p-3">
                                                <!-- description -->
                                                <p class="text-muted mb-2"><?php echo $course['course_description']; ?></p>
                                                <div class="d-flex align-items-center">
                                                    <!-- if the course is not the loggedin users list -->
                                                    <?php if (!in_array($course['course_id'], $u_saved_courses)) : ?>
                                                        <a href="#" class="btn btn-primary ml-auto add-course" data-course-id="<?php echo $course['course_id']; ?>" data-student-id="<?php echo $_SESSION['user_id']; ?>"><i class="material-icons">add</i></a>
                                                    <?php else : ?>
                                                        <a href="#" class="btn btn-danger ml-auto remove-course" data-course-id="<?php echo $course['course_id']; ?>" data-student-id="<?php echo $_SESSION['user_id']; ?>"><i class="material-icons">remove</i></a>
                                                    <?php endif; ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php endforeach; ?>

                            </div>
                            <hr>
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="form-inline">
                                    View
                                    <select class="custom-select ml-2">
                                        <option value="20" selected>20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                    </select>
                                </div>
                                <div class="ml-auto">
                                    20 <span class="text-muted">of 100</span> <a href="#" class="icon-muted"><i class="material-icons float-right">arrow_forward</i></a>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- // END drawer-layout__content -->

                    <?php include 'Components/sidebar.php'; ?>
                </div>
                <!-- // END drawer-layout -->

            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->
    </div>


    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default" :layout-location="{
      'default': 'student-courses.html',
      'fixed': 'fixed-student-courses.html',
      'fluid': 'fluid-student-courses.html',
      'mini': 'mini-student-courses.html'
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



</body>


</html>