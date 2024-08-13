<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once('Settings/core.php');

// Include the general function
include_once('Functions/general_function.php');

require('fpdf/fpdf.php');

// Check if the user is logged in
if (!logged_in()) {
    header("Location: login.php");
    exit();
}

// Get the topic name and id
$topic_name = isset($_GET['topic']) ? $_GET['topic'] : '';
$topic_id = isset($_GET['topic_id']) ? $_GET['topic_id'] : '';

// Get course for topic
$course = get_topic_course_details($topic_id);

// Get user learning style
$learning_style = get_user_learning_style($_SESSION['user_id']);

// Get the subsections
$subsections = get_topic_subsections($topic_id);

$i = 1;

if (!isset($_SESSION['content'])) {
    $_SESSION['content'] = $subsections[0]['name'];
}

// get quiz attempt
$quiz_attempts = get_quiz_attempts($_SESSION['user_id'], $topic_id);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>[<?php echo $topic_name; ?>]: <?php echo $course['course_name']; ?></title>

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
    <link type="text/css" href="assets/css/custom.css" rel="stylesheet">

    <script src="assets/vendor/jquery.min.js"></script>
    <script src="assets/js/topic_requests.js"></script>

</head>

<body class="layout-default">

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->
        <?php include 'Components/header.php'; ?>
        <!-- // END Header -->

        <div class="mdk-header-layout__content">
            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">

                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <div>
                                <h1 class="m-lg-0"><?php echo $topic_name; ?></h1>
                                <a href="single-course.php?course_id=<?php echo $course['course_id']; ?>&coursename=<?php echo $course['course_name']; ?>"><?php echo $course['course_name']; ?></a>
                            </div>
                            <!-- Game integration -->
                            <!-- Hidden iframe initially -->
                            <button class="close-btn" onclick="hideIframe()">×</button>
                            <iframe id="breakIframe" class="overlay-iframe" src="" style="display: none;"></iframe>
                            <div>
                                <button class="btn btn-success" onclick="callApi()">
                                    Take a break 🎮
                                </button>
                                <button class="btn btn-primary" onclick="openChat()">
                                    Ask ATTA 🤖
                                </button>
                                <div id="chatContainer" class="chat-container" style="display: none;">
                                    <div class="card card-bordered">
                                        <div class="card-header">
                                            <h4 class="card-title"><strong>Chat</strong></h4>
                                            <button class="btn btn-xs btn-danger" onclick="closeChat()"><i class="fa fa-times"></i></button>

                                        </div>
                                        <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:350px !important;">
                                            <!-- Chat messages will appear here -->
                                        </div>
                                        <div class="publisher bt-1 border-light">
                                            <input class="publisher-input" type="text" placeholder="Write something" id="chatInput">
                                            <button class="publisher-btn text-primary" onclick="sendMessage()"><i class="fa fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid page__container">
                        <div class="row">
                            <div class="col-md-4">

                                <!-- Lessons -->
                                <div class="card">
                                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                                        <div class="flex">
                                            <h4 class="card-header__title">Sections</h4>
                                        </div>
                                    </div>

                                    <ul class="list-group list-group-fit">
                                        <?php foreach ($subsections as $index => $subsection) : ?>
                                            <li id="subsection-<?php echo $subsection['subtopic_id']; ?>" class="list-group-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <div class="text-muted"><?php echo $i++; ?>.</div>
                                                    </div>
                                                    <div class="media-body">
                                                        <a href="#" class="subsection-link" data-section-id="<?php echo $subsection['subtopic_id']; ?>" data-content="<?php $content = get_subsection_content_textbook($subsection['subtopic_id']); echo htmlentities($content); ?>" data-slide="<?php $slide_content = get_subsection_content_slides($subsection['subtopic_id']); echo htmlentities($slide_content); ?>"><?php echo $subsection['subtopic_name']; ?></a>
                                                    </div>
                                                    <?php
                                                    $user_subsection = get_user_subsection_status($subsection['subtopic_id'], $_SESSION['user_id'], $topic_id);
                                                    ?>
                                                    <div class="media-right">
                                                        <?php if ($user_subsection == 1) : ?>
                                                            <small id="subsection-status-<?php echo $subsection['subtopic_id']; ?>" class="badge badge-soft-success">
                                                                COMPLETED
                                                            </small>
                                                        <?php else : ?>
                                                            <small id="subsection-status-<?php echo $subsection['subtopic_id']; ?>" class="badge badge-soft-danger">
                                                                NOT COMPLETED
                                                            </small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="text-muted"><?php echo $i++; ?>.</div>
                                                </div>
                                                <div class="media-body">
                                                    <a href="quiz-page.php?topic_name=<?php echo $topic_name; ?>&topic_id=<?php echo $topic_id; ?>" class="quiz-link">Try a Quiz?</a>
                                                </div>
                                                <div class="media-right">
                                                    <?php if ($quiz_attempts > 0) : ?>
                                                        <small class="badge badge-soft-success">COMPLETED</small>
                                                    <?php else : ?>
                                                        <small class="badge badge-soft-danger">NOT TAKEN</small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <?php include 'Components/related_topics.php'; ?>

                            </div>
                            <div class="col-md-8">
                                <!-- Add two buttons for the types of learning style: textbook style and slides style -->
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-light prev-btn w-100" onclick="setLearningStyle('Textbook Style')">Textbook Style</button>
                                    <button class="btn btn-light prev-btn w-100" onclick="setLearningStyle('Slides Style')">Slides Style</button>
                                </div>

                                <p></p>
                                <div class="card">
                                    <!-- Text area -->
                                    <div id="textbook" class="card-body" style="overflow-y: scroll; height: 800px;">
                                        <p class="card-text" id="contentDisplayTextbook">
                                            <!-- content here -->
                                        </p>
                                    </div>

                                    <div id="slides" class="card-body" style="overflow-y: scroll; height: 800px; display: none;">
                                        <p class="card-text" id="contentDisplaySlides">
                                            <!-- content here -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END drawer-layout__content -->

            <!-- sidebar -->
            <?php include 'Components/sidebar.php'; ?>

        </div>
        <!-- // END drawer-layout -->

    </div>
    <!-- // END header-layout -->

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
        var currentLearningStyle = "<?php echo $learning_style; ?>"; // Ensure learning_style is properly echoed as a string

        // Set the initial learning style view
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initial learning style:', currentLearningStyle);
            setLearningStyle(currentLearningStyle);
        });

        function setLearningStyle(style) {
            const textbookElement = document.getElementById('textbook');
            const slidesElement = document.getElementById('slides');

            currentLearningStyle = style;

            if (style === 'Textbook Style') {
                textbookElement.style.display = 'block';
                slidesElement.style.display = 'none';

            } else if (style === 'Slides Style') {
                textbookElement.style.display = 'none';
                slidesElement.style.display = 'block';
            }

            $.ajax({
                type: 'POST',
                url: 'Actions/set_learning_style.php',
                data: {
                    learning_style: style
                },
                success: function(response) {
                    console.log('Learning style set to:', style);
                }
            });
        }

        function check_status(subsection_id, topic_id) {
            $.ajax({
                url: 'Actions/subtopic_status.php',
                type: 'POST',
                data: {
                    subsection_id: subsection_id,
                    topic_id: topic_id,
                    user_id: <?php echo $_SESSION['user_id']; ?>
                },
                success: function(response) {
                    if (response == 1) {
                        $('#subsection-status-' + subsection_id).text('COMPLETED').removeClass('badge-soft-danger').addClass('badge-soft-success');
                    } else {
                        $('#subsection-status-' + subsection_id).text('NOT COMPLETED').removeClass('badge-soft-success').addClass('badge-soft-danger');
                    }
                }
            });
        }

        $(document).ready(function() {
            $('.list-group-item a').on('click', function(e) {
                e.preventDefault();

                if ($(this).hasClass('quiz-link')) {
                    window.location.href = $(this).attr('href');
                } else {
                    var subsection_id = $(this).data('section-id');
                    var topic_id = <?php echo $topic_id; ?>;
                    var content = $(this).data('content');
                    var slideContent = $(this).data('slide');

                    updateContent(subsection_id, content, slideContent, this);

                    // Remove active class from all list items
                    $('.list-group-item').removeClass('active');

                    // Add active class to the clicked list item
                    $(this).closest('.list-group-item').addClass('active');
                }
            });
        });

        function callApi() {
            var iframe = document.getElementById('breakIframe');
            var closeBtn = document.querySelector('.close-btn');

            // Set iframe src to call PHP cURL script with user details
            iframe.src = 'Actions/game-session.php';
            iframe.style.display = 'block';
            closeBtn.style.display = 'block';
        }

        function hideIframe() {
            var iframe = document.getElementById('breakIframe');
            var closeBtn = document.querySelector('.close-btn');

            iframe.style.display = 'none';
            closeBtn.style.display = 'none';
        }

        function updateContent(subsection_id, content, slideContent, element) {
            $.ajax({
                type: 'POST',
                url: 'Actions/section.php',
                data: {
                    sectionId: subsection_id,
                    content: content,
                    user_id: "<?php echo $_SESSION['user_id']; ?>",
                    status: '1'
                },
                success: function(response) {
                    var contentDisplayTextbook = document.getElementById('contentDisplayTextbook');
                    var contentDisplaySlides = document.getElementById('contentDisplaySlides');
                    contentDisplayTextbook.innerHTML = content; // Update content display with new content
                    contentDisplaySlides.innerHTML = slideContent; // Update slide content display with new content

                    if (currentLearningStyle === 'Textbook Style') {
                        contentDisplayTextbook.style.display = 'block';
                        contentDisplaySlides.style.display = 'none';
                    } else {
                        contentDisplayTextbook.style.display = 'none';
                        contentDisplaySlides.style.display = 'block';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                    alert('An error occurred: ' + error);
                }
            });
        }
    </script>
</body>

</html>
