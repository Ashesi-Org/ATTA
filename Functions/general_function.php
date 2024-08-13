<?php

// Include the general class
include(__DIR__. '/../Classes/general_class.php');

// Inserts
// Register a new user
function register_user($fname, $lname, $email, $password)
{
    $general = new general_class();
    return $general->register_user($fname, $lname, $email, $password);
}

// Insert completed quiz
function add_quiz_results($user_id, $topic_id)
{
    $general = new general_class();
    return $general->add_quiz_results($user_id, $topic_id);
}

// Insert quiz answers
function add_quiz_answers($quiz_id, $question_ids, $answers, $mark, $user_id, $course_id, $topic_id)
{
    $general = new general_class();
    return $general->add_quiz_answers($quiz_id, $question_ids, $answers, $mark, $user_id, $course_id, $topic_id);
}



// Selects
// Login a user

function get_all_users()
{
    $general = new general_class();
    return $general->get_all_users();
}

function login_user($email, $password)
{
    $general = new general_class();
    return $general->login_user($email, $password);
}

function get_LS_pretest()
{
    $general = new general_class();
    return $general->get_LS_pretest();
}

function get_learning_styles()
{
    $general = new general_class();
    return $general->get_learning_styles();
}

function get_user_learning_style($user_id)
{
    $general = new general_class();
    return $general->get_user_learning_style($user_id);
}

function subcount_topic($topic_id)
{
    $general = new general_class();
    return $general->subcount_topic($topic_id);
}

function get_subsection_content_textbook($subtopic_id)
{
    $general = new general_class();
    return $general->get_subsection_content_textbook($subtopic_id);
}

function get_subsection_content_slides($subtopic_id)
{
    $general = new general_class();
    return $general->get_subsection_content_slides($subtopic_id);
}

function get_user_learning_style1($user_id)
{
    $general = new general_class();
    return $general->get_user_learning_style1($user_id);
}

function insert_learning_style($user_id, $learning_style)
{
    $general = new general_class();
    return $general->insert_learning_style($user_id, $learning_style);
}

function get_pretest_answers($question_id)
{
    $general = new general_class();
    return $general->get_pretest_answers($question_id);
}

function get_question_by_id($question_id)
{
    $general = new general_class();
    return $general->get_question_by_id($question_id);
}

// Get user role
function get_user_role($user_id)
{
    $general = new general_class();
    return $general->get_user_role($user_id);
}

function get_user_first_name($user_id)
{
    $general = new general_class();
    return $general->get_user_first_name($user_id);
}

function add_course_admin($courseName, $courseDescription, $courseOverview)
{
    $general = new general_class();
    return $general->add_course_admin($courseName, $courseDescription, $courseOverview);
}

function add_topic_admin($courseId, $topicName)
{
    $general = new general_class();
    return $general->add_topic_admin($courseId, $topicName);
}

function add_subtopic_admin($topicId, $subtopicName)
{
    $general = new general_class();
    return $general->add_subtopic_admin($topicId, $subtopicName);
}

// Get the user ID
function get_user_id($email)
{
    $general = new general_class();
    return $general->get_user_id($email);
}

// Get the current user's courses
function get_user_courses($user_id)
{
    $general = new general_class();
    return $general->get_user_courses($user_id);
}

//  Get the course details
function get_course_details($course_id)
{
    $general = new general_class();
    return $general->get_course_details($course_id);
}

// Get course from topic
function get_topic_course_details($topic_id)
{
    $general = new general_class();
    return $general->get_topic_course_details($topic_id);
}

// Get questions for a select topic
function get_topic_questions($topic_id)
{
    $general = new general_class();
    return $general->get_topic_questions($topic_id);
}

function count_topic_questions($topic_id)
{
    $general = new general_class();
    return $general->count_topic_questions($topic_id);
}

function get_subtopics($topic_id)
{
    $general = new general_class();
    return $general->get_subtopics($topic_id);
}

function update_subsection_content($subtopic_id, $content, $style)
{
    $general = new general_class();
    return $general->update_subsection_content($subtopic_id, $content, $style);
}

function update_section_status($section_id, $status)
{
    $general = new general_class();
    return $general->update_section_status($section_id, $status);
}
// function to get all user quizzes
function get_user_quizzes($user_id)
{
    $general = new general_class();
    return $general->get_user_quizzes($user_id);
}

function update_course_progress($progress, $user_id, $course_id)
{
    $general = new general_class();
    return $general->update_course_progress($progress, $user_id, $course_id);
}

function get_quiz_attempts($user_id, $topic_id)
{
    $general = new general_class();
    return $general->get_quiz_attempts($user_id, $topic_id);
}

function complete_course($user_id, $course_id)
{
    $general = new general_class();
    return $general->complete_course($user_id, $course_id);
}

function get_questions_count($topic_id)
{
    $general = new general_class();
    return $general->get_questions_count($topic_id);
}

function get_topic_subsections_count($course_id)
{
    $general = new general_class();
    return $general->get_topic_subsections_count($course_id);
}

function get_user_subsection_status_count($course_id, $user_id)
{
    $general = new general_class();
    return $general->get_user_subsection_status_count($course_id, $user_id);
}

// Get questions for a select topic
function get_question($question_id)
{
    $general = new general_class();
    return $general->get_question($question_id);
}

function get_user_subsection_status($subsection_id, $user_id, $topic_id)
{
    $general = new general_class();
    return $general->get_user_subsection_status($subsection_id, $user_id, $topic_id);
}

// Get topic subsections
function get_topic_subsections($topic_id)
{
    $general = new general_class();
    return $general->get_topic_subsections($topic_id);
}

function num_attempts($user_id, $topic_id)
{
    $general = new general_class();
    return $general->num_attempts($user_id, $topic_id);
}

// Get user details
function get_user_details($user_id)
{
    $general = new general_class();
    return $general->get_user_details($user_id);
}

// Get all courses
function get_all_courses()
{
    $general = new general_class();
    return $general->get_all_courses();
}

// Count the number of courses
function count_courses()
{
    $general = new general_class();
    return $general->count_courses();
}

// Get all majors
function get_all_majors()
{
    $general = new general_class();
    return $general->get_all_majors();
}

//  Get all courses for a major
function get_major_courses($major_id)
{
    $general = new general_class();
    return $general->get_major_courses($major_id);
}

// Get number of students enrolled in a course
function count_course_students($course_id)
{
    $general = new general_class();
    return $general->count_course_students($course_id);
}

// Get user course
function get_user_course($user_id, $course_id)
{
    $general = new general_class();
    return $general->get_user_course($user_id, $course_id);
}

// Function to add course
function add_course($user_id, $course_id)
{
    $general = new general_class();
    return $general->add_course($user_id, $course_id);
}

// Function to remove course
function remove_course($user_id, $course_id)
{
    $general = new general_class();
    return $general->remove_course($user_id, $course_id);
}

// Function to get topics for a course
function get_course_topics($course_id)
{
    $general = new general_class();
    return $general->get_course_topics($course_id);
}

// Function to get the most recent quiz ID
function get_most_recent_quiz_id($user_id, $course_id)
{
    $general = new general_class();
    return $general->get_most_recent_quiz_id($user_id, $course_id);
}

function get_quiz_score($user_id, $topic_id)
{
    $general = new general_class();
    return $general->get_quiz_score($user_id, $topic_id);
}

// Get user saved courses
function get_user_saved_courses($user_id)
{
    $general = new general_class();
    return $general->get_user_saved_courses($user_id);
}

function get_all_topics()
{
    $general = new general_class();
    return $general->get_all_topics();
}

function check_enrolment($student_id, $course_id)
{
    $general = new general_class();
    return $general->check_enrolment($student_id, $course_id);
}

function get_pretest($course_id)
{
    $general = new general_class();
    return $general->get_pretest($course_id);
}

// Get quiz mark
function get_quiz_mark($question_ids, $answers)
{
    $general = new general_class();
    return $general->get_quiz_mark($question_ids, $answers);
}

// Get quiz results
function get_user_quiz_results($user_id, $course_id, $topic_id, $attempt_id)
{
    $general = new general_class();
    return $general->get_user_quiz_results($user_id, $course_id, $topic_id, $attempt_id);
}

function get_user_best_result($user_id, $course_id, $topic_id)
{
    $general = new general_class();
    return $general->get_user_best_result($user_id, $course_id, $topic_id);
}

// Get related topics
function get_related_topics($topic_id, $exclude_topic_id)
{
    $general = new general_class();
    return $general->get_related_topics($topic_id, $exclude_topic_id);
}

//  Get quiz attempts
function attempts($user_id, $topic_id)
{
    $general = new general_class();
    return $general->attempts($user_id, $topic_id);
}

// Get topic
function get_topic($topic_id)
{
    $general = new general_class();
    return $general->get_topic($topic_id);
}

// get correct answeres
function check_answer($question_id, $answer)
{
    $general = new general_class();
    return $general->check_answer($question_id, $answer);
}

//  Enroll student
function student_enrolment($student_id, $course_id)
{
    $general = new general_class();
    return $general->student_enrolment($student_id, $course_id);
}

// Assign topic
function assign_topic($student_id, $topic_id, $course_id, $subsection_id)
{
    $general = new general_class();
    return $general->assign_topic($student_id, $topic_id, $course_id, $subsection_id);
}

// Check assigned topic
function check_assignment($student_id, $topic_id, $course_id)
{
    $general = new general_class();
    return $general->check_assignment($student_id, $topic_id, $course_id);
}

// Get user topics
function get_assigned_topics($student_id, $course_id)
{
    $general = new general_class();
    return $general->get_assigned_topics($student_id, $course_id);
}

// Get user enrolled course
function get_enrollment($student_id, $course_id)
{
    $general = new general_class();
    return $general->get_enrollment($student_id, $course_id);
}