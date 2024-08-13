<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the general function
include_once(__DIR__ . "/../Functions/general_function.php");

// Include the core.php file
include_once(__DIR__ . "/../Settings/core.php");

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Get the topic id from the URL
$topic_id = $_GET['topic_id'];

// function to get topic
$topic = get_topic($topic_id)['name'];

// Call the function to get the course details from topic
$course_id = get_topic_course_details($topic_id)['id'];

// Get quiz attempts
$quiz_attempts = attempts($user_id, $course_id, $topic_id);

$i = 1;
$number = 0;

// Check if the session variable 'new_quiz_attempt' is set and equals to 1
$new_quiz_attempt = isset($_SESSION['new_quiz_attempt']) && $_SESSION['new_quiz_attempt'] == 1;
?>




<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h1 class="m-0">Past Quizzes</h1>
        <?php foreach ($quiz_attempts as $quiz_attempt) : ?>
        <?php $number++;
        endforeach; ?>
        <?php if ($number < 5) : ?>
            <form action="Actions/new_quiz_attempt.php" method="post">
                <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                <input type="hidden" name="topic" value="<?php echo $topic; ?>">
                
                <?php if (isset($_SESSION['new_quiz_attempt']) && ($_SESSION['new_quiz_attempt'] == 1)) : ?>
                    <button type="submit" class="btn btn-success ml-3" disabled>Quiz in Progress</button>
                <?php else: ?>
                    <button type="submit" name="new_quiz_attempt" class="btn btn-success ml-3">New Quiz Attempt?</button>
                <?php endif; ?>
            </form>
        <?php else : ?>
            <a href="#" class="btn btn-success ml-3" onclick="alert('You have reached the maximum number of quiz attempts for this topic')">New Quiz Attempt?</a>
        <?php endif; ?>
    </div>
</div>
<div class="card">
    <div class="card-header card-header-large bg-white d-flex align-items-center">
        <h4 class="card-header__title flex m-0">Past Quizzes</h4>
    </div>
    <div class="card-header card-header-tabs-basic nav" role="tablist">
        <?php foreach ($quiz_attempts as $index => $quiz_attempt) : ?>
            <a href="#attempt<?php echo $quiz_attempt['id']; ?>" class="nav-link <?php echo $index == 0 ? 'active' : ''; ?>" data-toggle="tab" role="tab" aria-controls="attempt<?php echo $quiz_attempt['id']; ?>" aria-selected="<?php echo $index == 0 ? 'true' : 'false'; ?>">Attempt <?php echo $i;
                                                                                                                                                                                                                                                                                            $i++;
                                                                                                                                                                                                                                                                                            ?></a>
        <?php endforeach; ?>
    </div>
    <div class="card-body tab-content">

        <?php foreach ($quiz_attempts as $index => $quiz_attempt) :
            $past_quizzes = get_user_quiz_results($user_id, $course_id, $topic_id, $quiz_attempt['id']); ?>
            <div class="tab-pane fade <?php echo $index == 0 ? 'active show' : ''; ?>" id="attempt<?php echo $quiz_attempt['id']; ?>">
                <!-- all quiz cards -->
                <div style="overflow-y: scroll; height: 360px;">
                    <?php if (!$new_quiz_attempt) : ?>
                        <!-- Section for total score -->
                        <div class="alert alert-soft-blue d-flex align-items-center card-margin p-2" role="alert">
                            <i class="material-icons mr-3">info</i>
                            <?php
                            $count = 0;
                            foreach ($past_quizzes as $quiz) :
                                if ($quiz['user_answer'] == $quiz['right_answer']) {
                                    $count++;
                                }
                            endforeach; ?>
                            <div class="text-body">Your correctly answered <strong class="text-primary"> <?php echo $count; ?></strong> question(s). </div>
                        </div>

                        <?php
                        $j = 1;
                        foreach ($past_quizzes as $quiz) : ?>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="media align-items-center">
                                            <div class="media-left">
                                                <h4 class="m-0 text-primary mr-2"><strong>#<?php echo $j;
                                                                                            $j++; ?></strong></h4>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="card-title m-0">
                                                    <a href="javascript:void(0)" class="text-body"><?php echo $quiz['question']; ?></a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php foreach (['choice_1', 'choice_2', 'choice_3', 'choice_4'] as $choice_index => $choice) : ?>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input id="customCheck<?php echo $quiz_attempt['id'] . $j . $choice_index; ?>" type="radio" <?php if ($quiz['user_answer'] != $quiz[$choice]) {
                                                                                                                                                    echo 'disabled';
                                                                                                                                                } else {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?> class="custom-control-input">
                                                    <label for="customCheck<?php echo $quiz_attempt['id'] . $j . $choice_index; ?>" class="custom-control-label"><?php echo $quiz[$choice]; ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="media-right">
                                            <?php if ($quiz['user_answer'] == $quiz['right_answer']) : ?>
                                                <small class="badge badge-soft-success">CORRECT</small>
                                            <?php else : ?>
                                                <small class="badge badge-soft-danger">WRONG</small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-soft-warning d-flex align-items-center card-margin p-2" role="alert">
                            <i class="material-icons mr-3">info</i>

                            <div class="text-body">Your results are currently muted because you are currently taking a quiz. </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>


    </div>
</div>