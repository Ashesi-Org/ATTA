<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once('Settings/core.php');

// Include the general function
include_once('Functions/general_function.php');

if (!logged_in()) {
    header("Location: login.php");
}

// Get the topic ID
$topic_id = $_GET['topic_id'];

// get topic details
$topic = get_topic($topic_id);

// Get the course details
$course = get_topic_course_details($topic_id);

// Get the questions for the topic
$questions = get_topic_questions($topic_id);

// Count the number of questions
$question_count = count_topic_questions($topic_id);

// Get the user ID
$user_id = $_SESSION['user_id'];

// check if there has been an attempt
$quiz = get_user_quizzes($user_id);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>[<?php echo $topic['topic_name']; ?>]: <?php echo $course['course_name']; ?></title>

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

    <script src="assets/js/quiz.js"></script>

    <script src="assets/js/gameAPI.js"></script>
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
                                <h1 class="m-lg-0">Assesment Quiz</h1>
                                <a href="topic.php?topic_id=<?php echo $topic['topic_id']; ?>&topic=<?php echo $topic['topic_name']; ?>"><?php echo $topic['topic_name']; ?></a>
                            </div>
                            <!-- Game integration -->
                            <div>
                                <button class="btn btn-success" onclick="callApi()">Take a break 🎮</button>
                            </div>
                        </div>
                    </div>


                    <div class="container-fluid page__container">
                        <div class="row">

                            <div class="col-md-8">
                                <div id="content">
                                    <div id="questions-container">
                                        <?php if (!$quiz || isset($_SESSION['new_quiz_attempt'])) : ?>

                                            <form id="quiz-form" method="POST" action="Actions/user_quiz_results.php">
                                                <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                                                <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                <?php foreach ($questions as $index => $question) : ?>
                                                    <input type="hidden" name="question_id[<?php echo $question['question_id']; ?>]" value="<?php echo $question['question_id']; ?>">
                                                    <div class="card question-card" id="question-<?php echo $question['question_id']; ?>" style="min-height: 390px; display:<?php if ($index != 0) echo 'none'; ?>;">
                                                        <div class="card-header">
                                                            <div class="media align-items-center">
                                                                <div class="media-left">
                                                                    <h4 class="m-0 text-primary mr-2"><strong>#<?php echo $index + 1; ?></strong></h4>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h4 class="card-title m-0"><?php echo $question['question_text']; ?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <?php for ($i = 1; $i <= 4; $i++) : ?>
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-radio">
                                                                        <input id="customRadio<?php echo $index . $i; ?>" name="answer[<?php echo $question['question_id']; ?>]" type="radio" class="custom-control-input" value="<?php echo isset($question['choice' . $i]) ? $question['choice' . $i] : 'Null'; ?>">
                                                                        <label for="customRadio<?php echo $index . $i; ?>" class="custom-control-label"><?php echo isset($question['choice' . $i]) ? $question['choice' . $i] : 'Null'; ?></label>
                                                                    </div>
                                                                </div>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="button" class="btn btn-light prev-btn" <?php if ($index == 0) echo 'disabled'; ?>>👈 Previous</button>
                                                            <?php if ($index != $question_count - 1) { ?>
                                                                <button type="button" class="btn btn-light next-btn float-right">Next 👉</button>
                                                            <?php } else { ?>
                                                                <button type="submit" class="btn btn-success float-right">Submit <i class="material-icons btn__icon--right">arrow_forward</i></button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </form>
                                        <?php else : ?>
                                            <!-- mute the quiz -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Quiz Muted</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mt-2 text-center">You already had a go. Your results are below.</p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- card underneath to show first attempt if there was one -->

                                    <?php
                                    $scoreData = get_quiz_score($user_id, $topic_id);
                                    if ($scoreData !== null && isset($scoreData['score'])) :
                                        $score = ($scoreData['score'] / 5) * 100;
                                    ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Previous Attempt</h4>
                                                <p class="card-subtitle">You scored <strong><?php echo $score; ?>%</strong></p>
                                            </div>
                                            <!-- div to visualize percentage -->
                                            <div class="card-body">
                                                <div class="progress" style="height: 10px; margin: 0 auto;">
                                                    <div class="progress-bar bg-<?php if ($score >= 80) : ?>success<?php elseif ($score >= 50) : ?>warning<?php else : ?>danger<?php endif; ?>" role="progressbar" style="width: <?php echo $score; ?>%" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div>
                                                    <!-- comments about the results -->
                                                    <?php if ($score >= 80) : ?>
                                                        <p class="mt-2 text-center">Great job! You're a genius!</p>
                                                    <?php elseif ($score >= 50) : ?>
                                                        <p class="mt-2 text-center">Not bad! You can do better.</p>
                                                    <?php else : ?>
                                                        <p class="mt-2 text-center">I think you should review the topic again.</p>
                                                    <?php endif; ?>
                                                    <?php if (num_attempts($user_id, $topic_id) < 2) : ?>
                                                        <p class="mt-2 text-center">You have 1 more attempt. <a href="Actions/new_quiz_attempt.php">Take it again?</a></p>
                                                    <?php else : ?>
                                                        <p class="mt-2 text-center">You have exhausted your attempts.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                    <!--  -->

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const questionCards = document.querySelectorAll('.question-card');
                                            let currentQuestion = 0;

                                            function showQuestion(index) {
                                                questionCards.forEach((card, idx) => {
                                                    card.style.display = idx === index ? 'block' : 'none';
                                                });
                                            }

                                            function isQuestionAnswered(index) {
                                                const questionCard = questionCards[index];
                                                const selectedOption = questionCard.querySelector('input[name^="answer"]:checked');
                                                return selectedOption !== null;
                                            }

                                            document.querySelectorAll('.next-btn').forEach((btn, idx) => {
                                                btn.addEventListener('click', () => {
                                                    if (isQuestionAnswered(currentQuestion)) {
                                                        if (currentQuestion < questionCards.length - 1) {
                                                            currentQuestion++;
                                                            showQuestion(currentQuestion);
                                                        }
                                                    } else {
                                                        showToast('warning', "Come on, you can't leave this blank");
                                                    }
                                                });
                                            });

                                            document.querySelectorAll('.prev-btn').forEach((btn, idx) => {
                                                btn.addEventListener('click', () => {
                                                    if (currentQuestion > 0) {
                                                        currentQuestion--;
                                                        showQuestion(currentQuestion);
                                                    }
                                                });
                                            });

                                            showQuestion(currentQuestion);
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <?php include 'Components/related_topics.php'; ?>
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
        <!-- // END header-layout__content -->
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>