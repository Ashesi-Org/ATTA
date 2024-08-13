<?php
//connect to database class
require(__DIR__ . "/../Settings/db_class.php");

/**
 *General class to handle all functions 
 */
/**
 *@author Nana Kofi Djan
 *
 */
class general_class extends db_connection
{
	//--INSERT--//

	// Register a new user
	public function register_user($fname, $lname, $email, $password)
	{
		$ndb = new db_connection();
		$fname = mysqli_real_escape_string($ndb->db_conn(), $fname);
		$lname = mysqli_real_escape_string($ndb->db_conn(), $lname);
		$email = mysqli_real_escape_string($ndb->db_conn(), $email);
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$password_hash = mysqli_real_escape_string($ndb->db_conn(), $password_hash);
		$sql = "INSERT INTO `Users`(`first_name`, `last_name`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$password_hash')";
		return $this->db_query($sql);
	}

	// Add quiz results
	public function add_quiz_results($user_id, $topic_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);

		$sql = "INSERT INTO `QuizResults`(`user_id`, `topic_id`, `taken_at`) VALUES ('$user_id', '$topic_id', NOW())";
		return $this->db_query($sql);
	}


	public function add_course_admin($courseName, $courseDescription, $courseOverview)
	{
		$ndb = new db_connection();
		$courseName = mysqli_real_escape_string($ndb->db_conn(), $courseName);
		$courseDescription = mysqli_real_escape_string($ndb->db_conn(), $courseDescription);
		$courseOverview = mysqli_real_escape_string($ndb->db_conn(), $courseOverview);

		$sql = "INSERT INTO `Courses`(`course_name`, `course_description`, `course_overview`) VALUES ('$courseName', '$courseDescription', '$courseOverview')";
		$this->db_query($sql);

		// get the last added course id
		$sql1 = "SELECT `course_id` FROM `Courses` ORDER BY `course_id` DESC LIMIT 1";
		$result1 = $this->db_fetch_one($sql1);
		$course_id = $result1['course_id'];

		if ($course_id) {
			return $course_id;
		} else {
			return false;
		}
	}

	public function get_question_by_id($question_id)
	{
		$ndb = new db_connection();
		$question_id = mysqli_real_escape_string($ndb->db_conn(), $question_id);
		$sql = "SELECT * FROM `LSQuestions` WHERE `question_id` = '$question_id'";
		$result = $this->db_fetch_one($sql);
		return $result['question_text'];
	}

	public function get_subsection_content_textbook($subtopic_id)
	{
		$ndb = new db_connection();
		$subtopic_id = mysqli_real_escape_string($ndb->db_conn(), $subtopic_id);
		$sql = "SELECT `content` FROM `Content` WHERE `subtopic_id` = '$subtopic_id' and `content_type` = 'textbook'";
		$result = $this->db_fetch_one($sql);
		return $result['content'];
	}

	public function get_subsection_content_slides($subtopic_id)
	{
		$ndb = new db_connection();
		$subtopic_id = mysqli_real_escape_string($ndb->db_conn(), $subtopic_id);
		$sql = "SELECT `content` FROM `Content` WHERE `subtopic_id` = '$subtopic_id' and `content_type` = 'lecture'";
		$result = $this->db_fetch_one($sql);
		return $result['content'];
	}

	public function insert_learning_style($user_id, $learning_style)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$learning_style = mysqli_real_escape_string($ndb->db_conn(), $learning_style);

		// get the learning style id
		$sql1 = "SELECT `style_id` FROM `LearningStyles` WHERE `style_name` = '$learning_style'";
		$result1 = $this->db_fetch_one($sql1);
		$learning_style_id = $result1['style_id'];

		$sql = "UPDATE `Users` SET `user_style` = $learning_style_id WHERE `user_id` = $user_id";
		return $this->db_query($sql);
	}

	public function get_user_learning_style($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "SELECT `user_style` FROM `Users` WHERE `user_id` = '$user_id'";
		$result = $this->db_fetch_one($sql);

		$sql1 = "SELECT `style_name` FROM `LearningStyles` WHERE `style_id` = " . $result['user_style'];
		$result1 = $this->db_fetch_one($sql1);
		return $result1['style_name'];
	}

	public function get_user_learning_style1($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "SELECT `user_style` FROM `Users` WHERE `user_id` = '$user_id'";
		$result = $this->db_fetch_one($sql);
		return $result['user_style'];
	}

	public function subcount_topic($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT COUNT(*) FROM `Subtopics` WHERE `topic_id` = '$topic_id'";
		$result = $this->db_fetch_one($sql);
		return $result['COUNT(*)'];
	}

	public function get_pretest_answers($question_id)
	{
		$ndb = new db_connection();
		$question_id = mysqli_real_escape_string($ndb->db_conn(), $question_id);
		$sql = "SELECT * FROM `LSPossibleAnswers` WHERE `question_id` = '$question_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	public function get_LS_pretest()
	{
		$ndb = new db_connection();
		$sql = "SELECT * FROM `LSQuestions`";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	public function get_learning_styles()
	{
		$ndb = new db_connection();
		$sql = "SELECT * FROM `LearningStyles`";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	public function get_user_first_name($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "SELECT `first_name` FROM `Users` WHERE `user_id` = '$user_id'";
		$result = $this->db_fetch_one($sql);
		return $result['first_name'];
	}

	// Add a topic
	public function add_topic_admin($courseId, $topicName)
	{
		$ndb = new db_connection();
		$courseId = mysqli_real_escape_string($ndb->db_conn(), $courseId);
		$topicName = mysqli_real_escape_string($ndb->db_conn(), $topicName);

		$sql = "INSERT INTO `Topics`(`course_id`, `topic_name`) VALUES ('$courseId', '$topicName')";
		$this->db_query($sql);

		// get the last added topic id
		$sql1 = "SELECT `topic_id` FROM `Topics` ORDER BY `topic_id` DESC LIMIT 1";
		$result1 = $this->db_fetch_one($sql1);
		$topic_id = $result1['topic_id'];

		if ($topic_id) {
			return $topic_id;
		} else {
			return false;
		}
	}

	// Add a subtopic
	public function add_subtopic_admin($topicId, $subtopicName)
	{
		$ndb = new db_connection();
		$topicId = mysqli_real_escape_string($ndb->db_conn(), $topicId);
		$subtopicName = mysqli_real_escape_string($ndb->db_conn(), $subtopicName);

		$sql = "INSERT INTO `Subtopics`(`topic_id`, `subtopic_name`) VALUES ('$topicId', '$subtopicName')";
		return $this->db_query($sql);
	}

	// Add quiz answers
	public function add_quiz_answers($quiz_id, $question_ids, $answers, $marks, $user_id, $course_id, $topic_id)
	{
		$ndb = new db_connection();
		$quiz_id = mysqli_real_escape_string($ndb->db_conn(), $quiz_id);

		foreach ($question_ids as $index => $question_id) {
			// Check if the answer is set
			if (!isset($answers[$index])) {
				$answers[$index] = 'blank';
			}

			$question_id = mysqli_real_escape_string($ndb->db_conn(), $question_id);
			$answer = mysqli_real_escape_string($ndb->db_conn(), $answers[$index]);
			$is_correct = isset($marks[$question_id]) && $marks[$question_id] ? 1 : 0; // Determine if the answer is correct

			// Insert the user's answer into the database
			$sql = "INSERT INTO `UserAnswers`(`result_id`, `question_id`, `selected_choice`, `is_correct`, `user_id`) 
					VALUES ('$quiz_id', '$question_id', '$answer', '$is_correct', '$user_id')";
			$this->db_query($sql);
		}

		// Count the number of correct answers
		$sql1 = "SELECT COUNT(*) AS correct_count FROM `UserAnswers` WHERE `result_id` = '$quiz_id' AND `is_correct` = 1";
		$result = $this->db_fetch_one($sql1);
		$right_answers = $result['correct_count'];

		// Call function to insert the mark into QuizResults
		return $this->add_quiz_mark($user_id, $course_id, $topic_id, $right_answers, $quiz_id);
	}

	// Add quiz mark to the QuizResults table
	public function add_quiz_mark($user_id, $course_id, $topic_id, $score, $quiz_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$score = mysqli_real_escape_string($ndb->db_conn(), $score);
		$quiz_id = mysqli_real_escape_string($ndb->db_conn(), $quiz_id);

		$sql = "INSERT INTO `QuizResults`(`result_id`, `user_id`, `topic_id`, `score`, `taken_at`) 
				VALUES ('$quiz_id', '$user_id', '$topic_id', '$score', NOW())
				ON DUPLICATE KEY UPDATE `score` = VALUES(`score`), `taken_at` = NOW()";
		$this->db_query($sql);
		return true;
	}

	public function get_quiz_score($user_id, $topic_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT `score` FROM `QuizResults` WHERE `user_id` = '$user_id' AND `topic_id` = '$topic_id' ORDER BY `score` DESC LIMIT 1";
		$result = $this->db_fetch_one($sql);
		return $result;
	}

	// Get the course of a specific user
	public function add_course($user_id, $course_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "INSERT INTO `SavedCourses`(`user_id`, `course_id`) VALUES ('$user_id', '$course_id')";
		return $this->db_query($sql);
	}

	// Remove a course from a user's list
	public function remove_course($user_id, $course_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "DELETE FROM `SavedCourses` WHERE `user_id` = '$user_id' AND `course_id` = '$course_id'";
		return $this->db_query($sql);
	}


	//--SELECT--//

	public function get_all_users()
	{
		$ndb = new db_connection();
		$sql = "SELECT * FROM `Users` WHERE `user_role` = '1'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	// Login a user
	public function login_user($email, $password)
	{
		$ndb = new db_connection();
		$email = mysqli_real_escape_string($ndb->db_conn(), $email);
		$sql = "SELECT `password` FROM `Users` WHERE `email` = '$email'";
		$password_hash = $this->db_fetch_one($sql);
		if (password_verify($password, $password_hash['password'])) {
			return true;
		} else {
			return false;
		}
	}

	// Get user role
	public function get_user_role($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "SELECT `user_role` FROM `Users` WHERE `user_id` = '$user_id'";
		$result = $this->db_fetch_one($sql);
		return $result['user_role'];
	}

	// Get the user ID
	public function get_user_id($email)
	{
		$ndb = new db_connection();
		$email = mysqli_real_escape_string($ndb->db_conn(), $email);
		$sql = "SELECT `user_id` FROM `Users` WHERE `email` = '$email'";
		$result = $this->db_fetch_one($sql);
		return $result['user_id'];
	}

	// Check if a user has a started or saved some courses, and return all the course IDs
	public function get_user_courses($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "
    SELECT 
        `EnrolledCourses`.`course_id`, 
        `EnrolledCourses`.`progress`
    FROM `EnrolledCourses`
    WHERE `EnrolledCourses`.`user_id` = '$user_id'
    ";
		$result = $this->db_fetch_all($sql);
		$courses = array();
		foreach ($result as $course) {
			$courses[] = array(
				'course_id' => $course['course_id'],
				'progress' => $course['progress']
			);
		}
		return $courses;
	}


	// Get the course details. This functions is to get the course details from two tables; courses and user courses
	public function get_course_details($course_id)
	{
		$ndb = new db_connection();
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT 
                `Courses`.`course_id`, 
                `AvailableCourses`.`availability_status` AS `status`, 
                `Courses`.`course_name`, 
                `Courses`.`course_description`, 
				`Courses`.`course_overview`, 
                `Courses`.`created_at`
            FROM `Courses`
            INNER JOIN `AvailableCourses` ON `Courses`.`course_id` = `AvailableCourses`.`course_id`
            WHERE `Courses`.`course_id` = '$course_id'";
		$result = $this->db_fetch_one($sql);
		return $result;
	}


	// Get logged in user details
	public function get_user_details($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "SELECT `user_id`, `first_name`, `last_name`, `email` FROM `Users` WHERE `user_id` = '$user_id'";
		$result = $this->db_fetch_one($sql);
		return $result;
	}

	// Get all courses
	public function get_all_courses()
	{
		$ndb = new db_connection();
		$sql = "SELECT 
					`Courses`.`course_id`, 
					`Courses`.`course_name`, 
					`Courses`.`course_description`, 
					`Courses`.`created_at`
				FROM 
					`Courses`";
		$result = $this->db_fetch_all($sql);
		return $result;
	}


	// Count the number of courses
	public function count_courses()
	{
		$ndb = new db_connection();
		$sql = "SELECT COUNT(*) FROM `Courses`";
		$result = $this->db_fetch_one($sql);
		return $result['COUNT(*)'];
	}

	// Get all majors
	public function get_all_majors()
	{
		$ndb = new db_connection();
		$sql = "SELECT `id`, `major_name` FROM `Majors`";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	//  Get all courses for a major
	public function get_major_courses($major_id)
	{
		$ndb = new db_connection();
		$major_id = mysqli_real_escape_string($ndb->db_conn(), $major_id);
		$sql = "SELECT `id`, `name`, `description`, `created_at`, `updated_at` FROM `Courses` WHERE `major_id` = '$major_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	// Get number of students enrolled in a course
	public function count_course_students($course_id)
	{
		$ndb = new db_connection();
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT COUNT(*) FROM `user_courses` WHERE `course_id` = '$course_id'";
		$result = $this->db_fetch_one($sql);
		return $result['COUNT(*)'];
	}

	// Get the course of a specific user and all the information of the course (topics, subsections, etc)
	public function get_user_course($user_id, $course_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "
		SELECT 
			`Courses`.`course_id` AS course_id,
			`Courses`.`course_name` AS course_name,
			`Courses`.`course_description` AS description,
			`Courses`.`created_at` AS course_created_at,
			`AvailableCourses`.`availability_status`,
			`EnrolledCourses`.`enrolled_at`,
			`EnrolledCourses`.`progress`
		FROM `Courses`
		LEFT JOIN `AvailableCourses` ON `Courses`.`course_id` = `AvailableCourses`.`course_id`
		LEFT JOIN `EnrolledCourses` ON `Courses`.`course_id` = `EnrolledCourses`.`course_id`
		WHERE `Courses`.`course_id` = '$course_id' AND `EnrolledCourses`.`user_id` = '$user_id'
		";
		$result = $this->db_fetch_one($sql);
		return $result;
	}





	// Get the topics for a certain course
	public function get_course_topics($course_id)
	{
		$ndb = new db_connection();
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT `topic_id`, `topic_name` FROM `Topics` WHERE `course_id` = '$course_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	// Get course from topic
	public function get_topic_course_details($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);

		$sql = "SELECT `Courses`.`course_id`, `Courses`.`course_name`, `Courses`.`course_description`, `Courses`.`created_at`
            FROM `Courses`
            WHERE `Courses`.`course_id` = (SELECT `course_id` FROM `Topics` WHERE `topic_id` = '$topic_id')";

		$result = $this->db_fetch_one($sql);
		return $result;
	}

	public function update_subsection_content($subtopic_id, $content, $style)
	{	
		// Check if the content already exists for the subtopic and style
		$ndb = new db_connection();
		$subtopic_id = mysqli_real_escape_string($ndb->db_conn(), $subtopic_id);
		$style = mysqli_real_escape_string($ndb->db_conn(), $style);
		$sql_check = "SELECT COUNT(*) as `count` FROM `Content` WHERE `subtopic_id` = '$subtopic_id' AND `content_type` = '$style'";
		$result_check = $this->db_fetch_one($sql_check);
		$count = $result_check['count'];

		if ($count == 0) {
			// Insert the content for the subtopic and style
			$sql = "INSERT INTO `Content`(`subtopic_id`, `content`, `content_type`) VALUES ('$subtopic_id', '$content', '$style')";
		} else {
			// Update the content for the subtopic and style
			$sql = "UPDATE `Content` SET `content` = '$content' WHERE `subtopic_id` = '$subtopic_id' AND `content_type` = '$style'";
		}

		return $this->db_query($sql);
	}

	public function get_subtopics($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT `subtopic_id`, `subtopic_name`, `topic_id`, `created_at` FROM `Subtopics` WHERE `topic_id` = '$topic_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	public function update_section_status($section_id, $status)
	{
		$ndb = new db_connection();
		$section_id = mysqli_real_escape_string($ndb->db_conn(), $section_id);
		$status = mysqli_real_escape_string($ndb->db_conn(), $status);
		$sql = "UPDATE `UsersTopics` SET `subtopic_status` = '$status' WHERE `subtopic_id` = '$section_id'";
		return $this->db_query($sql);
	}

	// Get user subsection status
	public function get_user_subsection_status($subsection_id, $user_id, $topic_id)
	{
		$ndb = new db_connection();
		$subsection_id = mysqli_real_escape_string($ndb->db_conn(), $subsection_id);
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT `subtopic_status` FROM `UsersTopics` WHERE `subtopic_id` = '$subsection_id' AND `user_id` = '$user_id' AND `topic_id` = '$topic_id'";
		$result = $this->db_fetch_one($sql);
		return $result['subtopic_status'];
	}

	public function get_quiz_attempts($user_id, $topic_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT COUNT(*) as `count` FROM `QuizResults` WHERE `user_id` = '$user_id' AND `topic_id` = '$topic_id'";
		$result = $this->db_fetch_all($sql);
		return $result[0]['count'];
	}

	public function get_questions_count($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT COUNT(*) as `count` FROM `MultipleChoiceQuestions` WHERE `topic_id` = '$topic_id'";
		$result = $this->db_fetch_all($sql);
		return $result[0]['count'];
	}

	public function get_topic_subsections_count($course_id)
	{
		$ndb = new db_connection();
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT COUNT(*) as `count`
FROM `Subtopics` 
INNER JOIN `Topics` ON `Subtopics`.`topic_id` = `Topics`.`topic_id`
WHERE `Topics`.`course_id` = '$course_id';
";
		$result = $this->db_fetch_all($sql);
		return $result[0]['count'];
	}

	public function complete_course($user_id, $course_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "UPDATE `EnrolledCourses` SET `completed` = 1 WHERE `user_id` = '$user_id' AND `course_id` = '$course_id'";
		return $this->db_query($sql);
	}

	public function update_course_progress($progress, $user_id, $course_id)
	{
		$ndb = new db_connection();
		$progress = mysqli_real_escape_string($ndb->db_conn(), $progress);
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "UPDATE `EnrolledCourses` SET `progress` = '$progress' WHERE `user_id` = '$user_id' AND `course_id` = '$course_id'";
		return $this->db_query($sql);
	}

	public function get_user_subsection_status_count($course_id, $user_id)
	{
		$ndb = new db_connection();
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "SELECT COUNT(*) as `count` FROM `UsersTopics` WHERE `user_id` = '$user_id' AND `course_id` = '$course_id' AND `subtopic_status` = '1'";
		$result = $this->db_fetch_all($sql);
		return $result[0]['count'];
	}

	// Get all user quizzes
	public function get_user_quizzes($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);

		$sql = "SELECT 
                `QuizResults`.`result_id`, 
                `QuizResults`.`score`, 
                `QuizResults`.`taken_at`, 
                `Topics`.`topic_name`, 
                `Courses`.`course_name`
            FROM 
                `QuizResults`
            INNER JOIN 
                `Topics` ON `QuizResults`.`topic_id` = `Topics`.`topic_id`
            INNER JOIN 
                `Courses` ON `Topics`.`course_id` = `Courses`.`course_id`
            WHERE 
                `QuizResults`.`user_id` = '$user_id'";

		$result = $this->db_fetch_all($sql);
		return $result;
	}

	public function num_attempts($user_id, $topic_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT COUNT(*) FROM `QuizResults` WHERE `user_id` = '$user_id' AND `topic_id` = '$topic_id'";
		$result = $this->db_fetch_one($sql);
		return $result['COUNT(*)'];
	}

	// Get subsections from topic
	public function get_topic_subsections($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT `subtopic_id`, `subtopic_name`, `topic_id`, `created_at` FROM `Subtopics` WHERE `topic_id` = '$topic_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}


	// Get the questions for a selected topic (including all subtopics under that topic)
	public function get_topic_questions($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT 
			q.question_id,
			q.question_text,
			q.topic_id,
			q.choice1,
			q.choice2,
			q.choice3,
			q.choice4,
			q.correct_answer,
			q.created_at
		FROM 
			MultipleChoiceQuestions q
		WHERE 
			q.topic_id = '$topic_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	// Get the questions for a select topic
	// Get a specific question by its ID
	public function get_question($question_id)
	{
		$question_id = mysqli_real_escape_string($this->db->db_conn(), $question_id);
		$sql = "SELECT 
			q.question_id,
			q.question_text,
			q.choice1,
			q.choice2,
			q.choice3,
			q.choice4,
			q.correct_answer,
			q.topic_id,
			q.created_at
		FROM 
			MultipleChoiceQuestions q
		WHERE 
			q.question_id = $question_id
		ORDER BY 
			q.question_id";

		$result = $this->db_fetch_all($sql);
		return $result;
	}

	// Get the rost recent quiz id
	public function get_most_recent_quiz_id($user_id, $course_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT `result_id` FROM `QuizResults` WHERE `user_id` = '$user_id' AND `topic_id` = '$course_id' ORDER BY `result_id` DESC LIMIT 1";
		$result = $this->db_fetch_one($sql);
		return $result['result_id'];
	}

	//  Get quiz mark
	public function get_quiz_mark($question_ids, $answers)
	{
		$ndb = new db_connection();
		$mark = [];

		foreach ($question_ids as $index => $question_id) {
			// Escape the question ID to prevent SQL injection
			$question_id = mysqli_real_escape_string($ndb->db_conn(), $question_id);

			// Check if an answer is provided, otherwise set it to 'blank'
			$answer = isset($answers[$index]) ? mysqli_real_escape_string($ndb->db_conn(), $answers[$index]) : 'blank';

			// Fetch the correct answer from the database
			$sql = "SELECT `correct_answer` FROM `MultipleChoiceQuestions` WHERE `question_id` = '$question_id'";
			$result = $ndb->db_fetch_one($sql);

			// Check if the user's answer matches the correct answer
			if ($result && $result['correct_answer'] == $answer) {
				$mark[$question_id] = 1;  // Correct answer
			} else {
				$mark[$question_id] = 0;  // Incorrect answer
			}
		}

		// Insert the total marks into the database
		// $sql = "INSERT INTO `quiz_results`(`user_id`, `course_id`, `topic_id`, `mark`) VALUES ('$user_id', '$course_id', '$topic_id', '$mark')";

		return $mark;
	}

	//  Get the user's quiz results for a certain topic, along with the quiz information like the questions and users answers, and the rite answers, and the choices for the question and the mark of that question
	// Get user quiz results for a specific topic
	public function get_user_quiz_results($user_id, $course_id, $topic_id, $attempt_id)
	{
		$user_id = mysqli_real_escape_string($this->db->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($this->db->db_conn(), $course_id);
		$topic_id = mysqli_real_escape_string($this->db->db_conn(), $topic_id);
		$attempt_id = mysqli_real_escape_string($this->db->db_conn(), $attempt_id);

		$sql = "SELECT 
			qr.result_id AS quiz_id,
			ua.question_id,
			ua.selected_choice AS user_answer,
			ua.is_correct AS mark,
			mcq.question_text,
			mcq.choice1,
			mcq.choice2,
			mcq.choice3,
			mcq.choice4,
			mcq.correct_answer,
			qr.topic_id,
			qr.score
		FROM 
			QuizResults qr
		JOIN 
			UserAnswers ua ON qr.result_id = ua.result_id
		JOIN 
			MultipleChoiceQuestions mcq ON ua.question_id = mcq.question_id
		WHERE
			qr.user_id = '$user_id' AND
			qr.course_id = '$course_id' AND
			qr.topic_id = '$topic_id' AND
			qr.result_id = '$attempt_id'
		ORDER BY
			ua.answer_id";

		$result = $this->db_fetch_all($sql);
		return $result;
	}

	//  Get users best result for a quiz in a certain topic of a certain course (the best score comes from the highest score in the list of users quizez for that topic)
	public function get_user_best_result($user_id, $course_id, $topic_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);

		$sql = "SELECT `QuizResults`.`score`, `Topics`.`course_id`, `QuizResults`.`topic_id`
            FROM `QuizResults`
            INNER JOIN `Topics` ON `QuizResults`.`topic_id` = `Topics`.`topic_id`
            WHERE `QuizResults`.`user_id` = '$user_id' 
            AND `Topics`.`course_id` = '$course_id' 
            AND `QuizResults`.`topic_id` = '$topic_id'
            ORDER BY `QuizResults`.`score` DESC
            LIMIT 1";

		$result = $this->db_fetch_one($sql);
		return $result;
	}


	public function get_all_topics()
	{
		$ndb = new db_connection();
		$sql = "SELECT * FROM `topics`";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	//  Get tpoics for the same course
	public function get_related_topics($course_id, $exclude_topic_id)
	{
		$ndb = new db_connection();
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$exclude_topic_id = mysqli_real_escape_string($ndb->db_conn(), $exclude_topic_id);
		$sql = "SELECT `topic_id`, `topic_name`, `created_at` FROM `Topics` WHERE `course_id` = '$course_id' AND `topic_id` != '$exclude_topic_id' LIMIT 3";
		$result = $this->db_fetch_all($sql);
		return $result;
	}



	// Get quiz attempts
	// Get all quiz attempts for a specific user and topic
	public function attempts($user_id, $topic_id)
	{
		$user_id = mysqli_real_escape_string($this->db->db_conn(), $user_id);
		$topic_id = mysqli_real_escape_string($this->db->db_conn(), $topic_id);
		$sql = "SELECT `result_id`, `score`, `taken_at` FROM `QuizResults` WHERE `user_id` = '$user_id' AND `topic_id` = '$topic_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	// Get the topic details
	public function get_topic($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT `topic_id`, `topic_name`, `created_at`, `course_id` FROM `Topics` WHERE `topic_id` = '$topic_id'";
		$result = $this->db_fetch_one($sql);
		return $result;
	}

	// Get user saved courses
	public function get_user_saved_courses($user_id)
	{
		$ndb = new db_connection();
		$user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
		$sql = "SELECT `course_id` FROM `SavedCourses` WHERE `user_id` = '$user_id'";
		$result = $this->db_fetch_all($sql);
		$course_ids = array();
		foreach ($result as $course) {
			array_push($course_ids, $course['course_id']);
		}
		return $course_ids;
	}

	public function check_enrolment($student_id, $course_id)
	{
		$ndb = new db_connection();
		$student_id = mysqli_real_escape_string($ndb->db_conn(), $student_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT * FROM `EnrolledCourses` WHERE `user_id` = '$student_id' AND `course_id` = '$course_id'";
		$result = $this->db_fetch_one($sql);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function get_pretest($course_id)
	{
		$ndb = new db_connection();
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT `pretest_id`, `pretest_question`, `pretest_topic`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `correct_answer` FROM `Pretests` WHERE `pretest_course` = '$course_id'";
		$result = $this->db_fetch_all($sql); // Fetch all pretest questions for the course
		return $result;
	}

	public function check_answer($question_id, $answer)
	{
		$ndb = new db_connection();
		$question_id = mysqli_real_escape_string($ndb->db_conn(), $question_id);
		$answer = mysqli_real_escape_string($ndb->db_conn(), $answer);
		$sql = "SELECT `correct_answer` FROM `Pretests` WHERE `pretest_id` = '$question_id'";
		$result = $this->db_fetch_one($sql);
		if ($result['correct_answer'] == $answer) {
			return true;
		} else {
			return false;
		}
	}

	//  Enroll student
	public function student_enrolment($student_id, $course_id)
	{
		$ndb = new db_connection();
		$student_id = mysqli_real_escape_string($ndb->db_conn(), $student_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "INSERT INTO `EnrolledCourses`(`user_id`, `course_id`) VALUES ('$student_id', '$course_id')";
		return $this->db_query($sql);
	}

	// Adssign topic to student
	public function assign_topic($student_id, $topic_id, $course_id, $subtopic_id)
	{
		$ndb = new db_connection();
		$student_id = mysqli_real_escape_string($ndb->db_conn(), $student_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$subtopic_id = mysqli_real_escape_string($ndb->db_conn(), $subtopic_id);
		$sql = "INSERT INTO `UsersTopics`(`user_id`, `topic_id`, `course_id`, `subtopic_id`) VALUES ('$student_id', '$topic_id', '$course_id', '$subtopic_id')";
		return $this->db_query($sql);
	}

	// Check if a user has been assigned a topic
	public function check_assignment($student_id, $topic_id, $course_id)
	{
		$ndb = new db_connection();
		$student_id = mysqli_real_escape_string($ndb->db_conn(), $student_id);
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT * FROM `UsersTopics` WHERE `user_id` = '$student_id' AND `topic_id` = '$topic_id' AND `course_id` = '$course_id'";
		$result = $this->db_fetch_one($sql);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	// Get all topics assigned to a user
	public function get_assigned_topics($student_id, $course_id)
	{
		$ndb = new db_connection();
		$student_id = mysqli_real_escape_string($ndb->db_conn(), $student_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT DISTINCT `topic_id` FROM `UsersTopics` WHERE `user_id` = '$student_id' AND `course_id` = '$course_id'";
		$result = $this->db_fetch_all($sql);
		return $result;
	}

	// Get user enrolled course
	public function get_enrollment($student_id, $course_id)
	{
		$ndb = new db_connection();
		$student_id = mysqli_real_escape_string($ndb->db_conn(), $student_id);
		$course_id = mysqli_real_escape_string($ndb->db_conn(), $course_id);
		$sql = "SELECT * FROM `EnrolledCourses` WHERE `user_id` = '$student_id' AND `course_id` = '$course_id'";
		$result = $this->db_fetch_one($sql);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function count_topic_questions($topic_id)
	{
		$ndb = new db_connection();
		$topic_id = mysqli_real_escape_string($ndb->db_conn(), $topic_id);
		$sql = "SELECT COUNT(*) FROM `MultipleChoiceQuestions` WHERE `topic_id` = '$topic_id'";
		$result = $this->db_fetch_one($sql);
		return $result['COUNT(*)'];
	}



	//--UPDATE--//



	//--DELETE--//


}
