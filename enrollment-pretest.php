<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once(__DIR__ . "/Functions/general_function.php");
include_once(__DIR__ . "/Settings/core.php");

if (!logged_in()) {
    header("Location: login.php");
}

//  Get user ID
$user_id = $_GET['user_id'];

// Get course id
$course_id = $_GET['course_id'];

//  Get course pretest questions
$pretest_questions = get_pretest($course_id);


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pretest</title>

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


    <style>
        .question-card {
            height: 380px;
            /* Set a fixed height for the cards */
            width: 750px;
            /* Set a fixed width for the cards */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin: 0 auto;
            /* Center the card horizontally */
        }

        .card-body {
            flex-grow: 1;
        }

        .card-body {
            flex-grow: 1;
        }

        .card-footer {
            margin-top: auto;
        }
    </style>

</head>

<body class="layout-login-centered-boxed">
    <div class="form">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-4 navbar-light">
            <a href="index.php" class="text-center text-light-gray mb-4">

                <!-- LOGO -->
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="60" height="60">
                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                        <path d="M12.177,7.4c-0.23,0-0.416,0.186-0.417,0.416v1.17c-0.011,0.23,0.166,0.426,0.396,0.437s0.426-0.166,0.437-0.396 c0.001-0.014,0.001-0.027,0-0.041V7.819c0.001-0.23-0.185-0.418-0.415-0.419C12.178,7.4,12.177,7.4,12.177,7.4z M7.51,18.486 c-0.23,0-0.416,0.186-0.416,0.416l0,0v0.585c-0.011,0.23,0.166,0.426,0.396,0.437s0.426-0.166,0.437-0.396 c0.001-0.014,0.001-0.027,0-0.041V18.9C7.925,18.671,7.739,18.487,7.51,18.486z M20.15,4.04c-0.232-0.047-0.4-0.252-0.4-0.489V2 c0-1.105-0.895-2-2-2H5.25c-1.637,0-2.972,1.311-3,2.948c0,0.017,0,18.052,0,18.052c0,1.657,1.343,3,3,3h14.5c1.105,0,2-0.895,2-2 V6C21.75,5.049,21.081,4.23,20.15,4.04z M4.25,3c0-0.552,0.448-1,1-1h12c0.276,0,0.5,0.224,0.5,0.5v1c0,0.276-0.224,0.5-0.5,0.5 h-12C4.698,4,4.25,3.552,4.25,3z M9.427,16.569c0,0.423-0.141,0.833-0.4,1.167c0.259,0.334,0.4,0.744,0.4,1.167v0.583 c-0.003,1.057-0.86,1.912-1.917,1.914H6.344c-0.414,0-0.75-0.336-0.75-0.75v-5.831c0-0.414,0.336-0.75,0.75-0.75H7.51 c1.058,0.002,1.915,0.859,1.917,1.917V16.569z M14.093,12.486c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75v-1.167 c-0.011-0.23-0.207-0.407-0.437-0.396c-0.214,0.011-0.386,0.182-0.396,0.396v1.167c0,0.414-0.336,0.75-0.75,0.75 s-0.75-0.336-0.75-0.75V7.819c0.024-1.058,0.902-1.897,1.96-1.873c1.024,0.023,1.849,0.848,1.873,1.873V12.486z M18.01,19.9 c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75c-1.702-0.002-3.081-1.382-3.083-3.084v-1.163 c0.002-1.702,1.381-3.082,3.083-3.084c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75c-0.874,0.001-1.582,0.71-1.583,1.584 v1.166C16.429,19.192,17.137,19.899,18.01,19.9z M7.51,15.569c-0.23,0-0.416,0.186-0.416,0.416l0,0v0.585 C7.083,16.8,7.26,16.996,7.49,17.007s0.426-0.166,0.437-0.396c0.001-0.014,0.001-0.027,0-0.041v-0.583 C7.927,15.757,7.74,15.57,7.51,15.569z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>

            </a>
        </div>

        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">Enrollment Pre-Test</strong></p>
                    <p class="text">Hmmm...</p>
                    <p class="text">You're back here...again 🌚.</p>
                    <p class="text">Spare a few minutes to take this text so we create your content for you.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <form id="pretestForm" action="Actions/enroll.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        <?php if (isset($pretest_questions) && is_array($pretest_questions)) : ?>
                            <?php foreach ($pretest_questions as $index => $q) : ?>
                                <input type="hidden" name="question-<?php echo $index; ?>" value="<?php echo htmlspecialchars($q['pretest_question']); ?>">

                                <input type="hidden" name="topic_id-<?php echo $index; ?>" value="<?php echo htmlspecialchars($q['pretest_topic']); ?>">
                                <?php if (is_array($q) && isset($q['pretest_question'])) : ?>
                                    <div class="card question-card" id="question-<?php echo $index; ?>" style="<?php echo $index === 0 ? '' : 'display: none;'; ?>; min-height: 300px;">
                                        <div class="card-header">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="card-title m-0">
                                                        <strong><?php echo htmlspecialchars($q['pretest_question']); ?></strong>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input id="customRadio-<?php echo $index; ?>-1" name="answer-<?php echo $index; ?>" type="radio" class="custom-control-input" value="<?php echo htmlspecialchars($q['answer_1']); ?>">
                                                    <label for="customRadio-<?php echo $index; ?>-1" class="custom-control-label"><?php echo htmlspecialchars($q['answer_1']); ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input id="customRadio-<?php echo $index; ?>-2" name="answer-<?php echo $index; ?>" type="radio" class="custom-control-input" value="<?php echo htmlspecialchars($q['answer_2']); ?>">
                                                    <label for="customRadio-<?php echo $index; ?>-2" class="custom-control-label"><?php echo htmlspecialchars($q['answer_2']); ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input id="customRadio-<?php echo $index; ?>-3" name="answer-<?php echo $index; ?>" type="radio" class="custom-control-input" value="<?php echo htmlspecialchars($q['answer_3']); ?>">
                                                    <label for="customRadio-<?php echo $index; ?>-3" class="custom-control-label"><?php echo htmlspecialchars($q['answer_3']); ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input id="customRadio-<?php echo $index; ?>-4" name="answer-<?php echo $index; ?>" type="radio" class="custom-control-input" value="<?php echo htmlspecialchars($q['answer_1']); ?>">
                                                    <label for="customRadio-<?php echo $index; ?>-4" class="custom-control-label"><?php echo htmlspecialchars($q['answer_4']); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <?php if ($index > 0) : ?>
                                                <button type="button" class="btn btn-light prev-btn" data-index="<?php echo $index; ?>">👈 Previous</button>
                                            <?php endif; ?>
                                            <?php if ($index < count($pretest_questions) - 1) : ?>
                                                <button type="button" class="btn btn-light next-btn float-right" data-index="<?php echo $index; ?>">👉 Next</button>
                                            <?php else : ?>
                                                <button type="submit" class="btn btn-success float-right">Submit <i class="material-icons btn__icon--right">arrow_forward</i></button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-danger">Invalid question data at index <?php echo $index; ?>.</div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="alert alert-danger">No pretest questions available.</div>
                        <?php endif; ?>
                    </form>
                </div>

            </div>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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