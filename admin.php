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

// Get all users
$users = get_all_users();

// Get all courses
$courses = get_all_courses();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>

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
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCourseForm" action="Actions/addcourse.php" method="POST">
                        <div class="form-group">
                            <label for="courseName">Course Name</label>
                            <input type="text" class="form-control" id="courseName" name="courseName" placeholder="Enter course name" required>
                        </div>
                        <div class="form-group">
                            <label for="courseDescription">Course Description</label>
                            <textarea class="form-control" id="courseDescription" name="courseDescription" rows="3" placeholder="Enter course description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="courseOverview">Course Overview</label>
                            <textarea class="form-control" id="courseOverview" name="courseOverview" rows="3" placeholder="Enter course overview" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="courseTopics">Course Topics and Subtopics</label>
                            <div id="courseTopics">
                                <div class="topic-group mb-2">
                                    <input type="text" class="form-control topic-input mb-2" name="topics[]" placeholder="Enter topic" required>
                                    <div class="subtopics-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="subtopics[0][]" placeholder="Enter subtopic" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary add-subtopic" type="button">Add Subtopic</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-secondary add-topic" type="button">Add Topic</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <div>
                            <div class="container-fluid page__heading-container">
                                <div class="page__heading d-flex align-items-center justify-content-between">
                                    <h1 class="m-0">Users</h1>
                                </div>
                            </div>

                            <div class="container-fluid page__container">
                                <div class="row">
                                    <!-- Table for all registered users -->
                                    <div class="col-lg-12">
                                        <div class="card card-form">
                                            <div class="table-responsive" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50px;">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input js-toggle-check-all" data-target="#users" id="customCheckAll">
                                                                    <label class="custom-control-label" for="customCheckAll"><span class="text-hide">Toggle all</span></label>
                                                                </div>
                                                            </th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Registered</th>
                                                            <th style="width: 120px;">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="users">
                                                        <?php foreach ($users as $user) : ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="user_<?php echo $user['user_id']; ?>">
                                                                        <label class="custom-control-label" for="user_<?php echo $user['user_id']; ?>"><span class="text-hide">Check</span></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex">
                                                                            <a href="student-profile.html" class="js-lists-values-employee-name"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $user['email']; ?></td>
                                                                <td><?php if(get_user_role($user['user_role']) == 1): echo 'Student'; endif; ?></td>
                                                                <td><?php echo $user['created_at']; ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="student-profile.html" class="btn btn-white btn-sm"><i class="material-icons">visibility</i></a>
                                                                        <a href="edit-user.html" class="btn btn-white btn-sm"><i class="material-icons">edit</i></a>
                                                                        <a href="delete-user.html" class="btn btn-white btn-sm"><i class="material-icons">delete</i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // END col-lg-12 -->
                                </div>
                                <!-- // END row -->
                            </div>
                            <!-- // END container-fluid page__container -->
                        </div>
                        <!-- Courses table -->
                        <div>
                            <div class="container-fluid page__heading-container">
                                <div class="page__heading d-flex align-items-center justify-content-between">
                                    <h1 class="m-0">Courses</h1>
                                    <!-- add course button -->
                                    <button class="btn btn-primary" style="margin-left: 20px; margin-bottom: 20px;" data-toggle="modal" data-target="#addCourseModal">Add Course</button>
                                </div>
                            </div>

                            <div class="container-fluid page__container">
                                <div class="row">
                                    <!-- Table for all registered courses -->
                                    <div class="col-lg-12">
                                        <div class="card card-form">
                                            <div class="table-responsive" data-toggle="lists" data-lists-values='["js-lists-values-course-name"]'>
                                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50px;">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input js-toggle-check-all" data-target="#courses" id="customCheckAllCourses">
                                                                    <label class="custom-control-label" for="customCheckAllCourses"><span class="text-hide">Toggle all</span></label>
                                                                </div>
                                                            </th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Published</th>
                                                            <th style="width: 120px;">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="courses">
                                                        <?php foreach ($courses as $course) : ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="course_<?php echo $course['course_id']; ?>">
                                                                        <label class="custom-control-label" for="course_<?php echo $course['course_id']; ?>"><span class="text-hide">Check</span></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex">
                                                                            <a href="course-details.html" class="js-lists-values-course-name"><?php echo $course['course_name']; ?></a>
                                                                        </div>
                                                                </td>
                                                                <td><?php echo $course['course_description']; ?></td>
                                                                <td><?php echo $course['created_at']; ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="admin-course-details.php?course_id=<?php echo $course['course_id']; ?>" class="btn btn-white btn-sm"><i class="material-icons">visibility</i></a>
                                                                        <a href="edit-course.html" class="btn btn-white btn-sm"><i class="material-icons">edit</i></a>
                                                                        <a href="delete-course.html" class="btn btn-white btn-sm"><i class="material-icons">delete</i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // END col-lg-12 -->
                                </div>
                                <!-- // END row -->
                            </div>
                            <!-- // END container-fluid page__container -->
                        </div>

                    </div>

                    <?php include 'Components/sidebar.php'; ?>

                </div>
                <!-- // END mdk-drawer-layout -->
            </div>
            <!-- // END header-layout__content -->
        </div>
        <!-- // END header-layout -->
    </div>
    <!-- // END content-area -->

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

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Add new topic input field
            document.getElementById('courseTopics').addEventListener('click', function(e) {
                if (e.target.classList.contains('add-topic')) {
                    const topicCount = document.querySelectorAll('.topic-group').length;
                    const topicInput = `
                        <div class="topic-group mb-2">
                            <input type="text" class="form-control topic-input mb-2" name="topics[]" placeholder="Enter topic" required>
                            <div class="subtopics-container">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="subtopics[${topicCount}][]" placeholder="Enter subtopic" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary add-subtopic" type="button">Add Subtopic</button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary add-topic" type="button">Add Topic</button>
                        </div>`;
                    document.getElementById('courseTopics').insertAdjacentHTML('beforeend', topicInput);
                }
            });

            // Add new subtopic input field
            document.getElementById('courseTopics').addEventListener('click', function(e) {
                if (e.target.classList.contains('add-subtopic')) {
                    const subtopicContainer = e.target.closest('.subtopics-container');
                    const topicIndex = Array.from(document.querySelectorAll('.subtopics-container')).indexOf(subtopicContainer);
                    const subtopicInput = `
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="subtopics[${topicIndex}][]" placeholder="Enter subtopic" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary remove-subtopic" type="button">Remove</button>
                            </div>
                        </div>`;
                    subtopicContainer.insertAdjacentHTML('beforeend', subtopicInput);
                }

                // Remove subtopic input field
                if (e.target.classList.contains('remove-subtopic')) {
                    e.target.closest('.input-group').remove();
                }
            });
        });
    </script>

</body>

</html>
