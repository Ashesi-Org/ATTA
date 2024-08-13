-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2024 at 03:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ITS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Achievements`
--

CREATE TABLE `Achievements` (
  `achievement_id` int(11) NOT NULL,
  `achievement_name` varchar(255) NOT NULL,
  `achievement_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Achievements`
--

INSERT INTO `Achievements` (`achievement_id`, `achievement_name`, `achievement_description`, `created_at`) VALUES
(1, 'Course Completion', 'Completed all topics in a course', '2024-07-24 22:43:38'),
(2, 'Quiz Master', 'Achieved a perfect score on a quiz', '2024-07-24 22:43:38'),
(3, 'Consistent Learner', 'Logged in every day for a week', '2024-07-24 22:43:38'),
(4, 'Top Performer', 'Ranked in the top 10% of the class', '2024-07-24 22:43:38'),
(5, 'Course Completion', 'Completed all topics in a course', '2024-07-24 22:55:46'),
(6, 'Quiz Master', 'Achieved a perfect score on a quiz', '2024-07-24 22:55:46'),
(7, 'Consistent Learner', 'Logged in every day for a week', '2024-07-24 22:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `AvailableCourses`
--

CREATE TABLE `AvailableCourses` (
  `available_course_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `availability_status` enum('available','unavailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `AvailableCourses`
--

INSERT INTO `AvailableCourses` (`available_course_id`, `course_id`, `availability_status`) VALUES
(1, 1, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `Content`
--

CREATE TABLE `Content` (
  `content_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `content_type` enum('textbook','lecture') NOT NULL,
  `subtopic_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Content`
--

INSERT INTO `Content` (`content_id`, `content`, `content_type`, `subtopic_id`, `created_at`) VALUES
(8, '<h3>Introduction:</h3><p>In the realm of Java programming, understanding simple data structures like variables, strings, and enums is fundamental. Enum types in Java provide a more elegant way to represent choices from a finite set, while wrapper types facilitate working with object types. Automatic boxing and unboxing simplify the conversion between base types and their corresponding wrapper types. Additionally, adhering to readability and programming conventions is crucial for writing maintainable and understandable code.</p><p><br></p><h3>Theoretical Foundation:</h3><p>Enum types in Java restrict variables to a specified set of values, making code more readable and maintainable. Wrapper types in Java provide classes for each base type to work with object-oriented structures. Automatic boxing and unboxing allow seamless conversion between base types and their wrapper types, enhancing code flexibility. Readability and programming conventions emphasize using meaningful names, constants, and organizing code for clarity.</p><p><br></p><h3>Implementation and Practical Application:</h3><p>``<code>java</code></p><p><code>// Enum Types</code></p><p><code>public enum Day { MON, TUE, WED, THU, FRI, SAT, SUN };</code></p><p><code>Day today = Day.TUE;</code></p><p><code>// Wrapper Types</code></p><p><code>Integer a = new Integer(12);</code></p><p><code>int k = a; // Implicit unboxing</code></p><p><code>int m = j + a; // Automatic unboxing</code></p><p><code>a = 3 * m; // Automatic boxing</code></p><p><code>// Readability and Programming Conventions</code></p><p><code>public class Student {</code></p><p><code>public static final int MIN_CREDITS = 12;</code></p><p><code>public static final int MAX_CREDITS = 24;</code></p><p><code>public enum Year { FRESHMAN, SOPHOMORE, JUNIOR, SENIOR };</code></p><p><code>// Instance variables, constructors, and method definitions go here...</code></p><p><code>}</code></p><p>``</p><h3>Analysis:</h3><p>Enum types and wrapper types offer a structured approach to data representation in Java, enhancing code organization and readability. Automatic boxing and unboxing simplify type conversions, reducing code complexity. Adhering to programming conventions improves code maintainability and understanding. However, excessive use of enums or wrappers can lead to unnecessary complexity in code.</p><p><br></p><h3>Real-world Applications:</h3><ol><li>Enum types are commonly used in applications involving state transitions, like game development.</li><li>Wrapper types are essential in scenarios where object-oriented structures are preferred over primitive types for compatibility with Java libraries.</li></ol><p><br></p><h3>Summary and Key Takeaways:</h3><p>Understanding simple data structures like variables, strings, and enums is crucial in Java programming. Enum types, wrapper types, and programming conventions play a significant role in code organization, readability, and flexibility.</p><p><br></p><h3>Discussion Questions and Exercises:</h3><ol><li>How does using enums improve code readability compared to using constants?</li><li>Implement a class that utilizes wrapper types for handling numerical calculations.</li></ol>', 'textbook', 3, '2024-08-03 19:44:14'),
(9, '<h2>Simple Data Structures in Java: Variables, Strings, Enums</h2><h3>Definition:</h3><p>Basic data structures in Java are used to store and represent different types of data.</p><h3>Key Characteristics:</h3><p>- Variables store single values of primitive types.</p><p>- Strings store sequences of characters.</p><p>- Enums represent a set of named constant values.</p><h3>Operations:</h3><p>- Variables: Declaration, initialization, assignment.</p><p>- Strings: Concatenation, comparison, substring.</p><p>- Enums: Accessing values, comparison.</p><h3>Advantages:</h3><p>- Variables provide flexibility in storing different types of data.</p><p>- Strings offer methods for manipulation and comparison.</p><p>- Enums ensure type safety and readability in code.</p><h3>Disadvantages:</h3><p>- Variables can lead to mutable state and potential errors.</p><p>- Strings can be memory-intensive for large operations.</p><p>- Enums may not be suitable for dynamic or changing values.</p><h3>Use Cases:</h3><p>- Variables: Storing numerical values, boolean flags.</p><p>- Strings: Handling text input, parsing data.</p><p>- Enums: Representing fixed sets like days of the week.</p><h3>Implementation Hint:</h3><p>- Variables: int count = 5; // declaring an integer variable.</p><p>- Strings: String message = \"Hello\"; // initializing a string variable.</p><p>- Enums: public enum Day {MON, TUE, WED}; // defining an enum for days.</p><h3>Comparison:</h3><p>Variables store single values, strings store sequences of characters, and enums represent a fixed set of named values.</p><h3>Key Takeaway:</h3><p>Understanding variables, strings, and enums in Java is essential for basic data handling and representation in programming.</p>', 'lecture', 3, '2024-08-03 20:04:59'),
(10, '<h3>Course Introduction</h3><p>In the realm of computer science, recursion is a fundamental concept that plays a pivotal role in problem-solving and algorithm design. Recursion involves solving a problem by breaking it down into smaller, similar subproblems, and then solving those subproblems recursively. This technique allows for elegant and concise solutions to a wide range of computational challenges. Recursion is not only a powerful tool for solving problems but also a key concept in understanding various data structures and algorithms.</p><p><br></p><p>Within the broader context of the Data Structures and Algorithms course, recursion is often introduced as a foundational concept that underpins many advanced topics. Understanding recursion is crucial for grasping complex algorithms, such as divide and conquer strategies, tree traversal, and dynamic programming. By mastering recursion, students can enhance their problem-solving skills and develop a deeper understanding of how algorithms work.</p><p><br></p><p>The historical context of recursion in computer science dates back to the early days of programming languages and algorithm design. Recursion has been a topic of interest for renowned computer scientists and mathematicians, such as Edsger Dijkstra and John McCarthy. Over time, recursion has become a standard technique used in various programming paradigms, including functional programming languages like Lisp and Haskell. Its evolution and widespread adoption highlight its significance in the field of computer science.</p>', 'textbook', 1, '2024-08-04 08:42:35'),
(11, '<h3>Introduction:</h3><p>Linear arrays are a fundamental data structure in computer science, allowing for the storage of elements in a contiguous block of memory. Multi-dimensional arrays, on the other hand, extend this concept to represent data in multiple dimensions, commonly used in applications like positional games. Understanding the implementation and manipulation of linear and multi-dimensional arrays is crucial for efficient data storage and retrieval in various algorithms and applications.</p><p>In the context of the broader topic of data structures and algorithms, arrays serve as the building blocks for more complex data structures and algorithms. Linear arrays are often the simplest form of data structure, while multi-dimensional arrays add a layer of complexity by organizing data in rows and columns. The evolution of arrays has been integral to the development of computer science, providing a foundational structure for storing and accessing data efficiently.</p><p><br></p><h3>Theoretical Foundation:</h3><p><u>Key Concepts:</u></p><ul><li>Linear Arrays: Linear arrays, also known as one-dimensional arrays, store elements in a single row or column. Elements are accessed using a single index, allowing for efficient retrieval and manipulation of data.</li><li>Multi-dimensional Arrays: Multi-dimensional arrays extend the concept of linear arrays by organizing data in multiple dimensions, typically rows and columns. They are represented as arrays of arrays, enabling the storage of structured data in a grid-like format.</li><li>Array Declaration and Initialization: Arrays in Java are declared using square brackets after the data type. Initialization can be done using literal values or the new operator, with elements automatically assigned default values.</li><li>Array Cloning: Cloning arrays in Java involves creating a copy of an existing array. The clone() method creates a shallow copy of the array, preserving the original structure but not the contents of nested arrays.</li><li>Equivalence Testing: Equivalence testing in arrays involves comparing arrays for equality. Java provides methods like equals() and deepEquals() to check for equivalence based on the contents of arrays.</li></ul><p><br></p><h3>Implementation and Practical Application:</h3><p>In Java, linear arrays are implemented by declaring and initializing arrays using square brackets. Here is an example of declaring, initializing, and accessing elements in a linear array:</p><p>``<code>java</code></p><p><code>int[] linearArray = {1, 2, 3, 4, 5};</code></p><p><code>int element = linearArray[2]; // Accessing the third element</code></p><p><code>System.out.println(element); // Output:</code></p><p><code>3</code></p><p>`</p><p><code>For multi-dimensional arrays, you can declare and initialize a two-dimensional array as follows:</code></p><p>`<code>java</code></p><p><code>int[][] multiArray = new int[3][3]; // 3x3 two-dimensional array</code></p><p><code>multiArray[1][2] = 10; // Assigning a value to a specific cell</code></p><p>``</p><h3>Analysis:</h3><p>Time and space complexity considerations for linear and multi-dimensional arrays depend on the operations performed. Accessing elements in arrays is typically O(1) time complexity, as elements are stored contiguously in memory. Cloning arrays involves additional memory allocation, impacting space complexity.</p><p>Comparing linear and multi-dimensional arrays, multi-dimensional arrays provide a structured way to represent data in grids, suitable for applications like games or image processing. However, they may consume more memory compared to linear arrays due to their nested structure.</p><p><br></p><h3>Real-world Applications:</h3><p>Linear arrays are commonly used in algorithms for sorting, searching, and storing sequential data like sensor readings or user inputs. Multi-dimensional arrays find applications in image processing, game development, and scientific simulations where data is organized in rows and columns.</p><p><br></p><h3>Summary and Key Takeaways:</h3><p>Linear arrays store elements in a single row or column, while multi-dimensional arrays extend this concept to multiple dimensions. Understanding array declaration, initialization, and equivalence testing is essential for efficient data manipulation. Arrays play a crucial role in various algorithms and applications, providing a structured way to store and access data.</p>', 'textbook', 4, '2024-08-04 08:45:35'),
(12, '<h2>Linear and Multi-dimensional Arrays</h2><p><br></p><p><strong>Definition:</strong></p><p>Linear arrays are one-dimensional arrays where elements are accessed using a single index, while multi-dimensional arrays, like two-dimensional arrays, use multiple indices to represent data in a two-dimensional space.</p><p><br></p><p><strong>Key Characteristics:</strong></p><p>- Linear arrays have a single index to access elements.</p><p>- Multi-dimensional arrays use two or more indices to access elements.</p><p>- Linear arrays are simpler and more common.</p><p>- Multi-dimensional arrays are used to represent data in multiple dimensions.</p><p><br></p><p><strong>Operations:</strong></p><p>- Accessing an element: O(1) for both linear and multi-dimensional arrays.</p><p>- Insertion/Deletion: O(n) for linear arrays, O(n^2) for multi-dimensional arrays.</p><p>- Searching: O(n) for linear arrays, O(n^2) for multi-dimensional arrays.</p><p><br></p><p><strong>Advantages:</strong></p><p>- Linear arrays are easier to work with and understand.</p><p>- Multi-dimensional arrays are useful for representing complex data structures.</p><p><br></p><p><strong>Disadvantages:</strong></p><p>- Linear arrays can be limiting for complex data structures.</p><p>- Multi-dimensional arrays can be harder to manage and visualize.</p><p><br></p><p><strong>Use Cases:</strong></p><p>- Linear arrays: Storing lists of items, simple data structures.</p><p>- Multi-dimensional arrays: Representing game boards and matrices in mathematical computations.</p><p><br></p><p><strong>Implementation Hint:</strong></p><p>- Java two-dimensional array declaration: <code>int[][] data = new int[8][10];</code></p><p><br></p><p><strong>Comparison:</strong></p><p>Linear arrays are simpler and more common, while multi-dimensional arrays are used for representing data in multiple dimensions.</p><p><br></p><p><strong>Key Takeaway:</strong></p><p>Linear arrays use a single index for element access, while multi-dimensional arrays use multiple indices for representing data in multiple dimensions.</p>', 'lecture', 4, '2024-08-04 08:48:49'),
(13, '<h2>Introduction to Data Structures</h2><p><br></p><p><strong>Definition:</strong></p><p>Data structures are ways of organizing and storing data in a computer so that it can be accessed and modified efficiently.</p><p><br></p><p><strong>Key Characteristics:</strong></p><p>	•	Provide efficient ways to store, retrieve, and manipulate data.</p><p>	•	Different types include arrays, linked lists, stacks, queues, trees, graphs, hash tables, and more.</p><p>	•	Each data structure is suited to specific types of operations and access patterns.</p><p>	•	They form the foundation for designing efficient algorithms.</p><p><br></p><p><strong>Operations:</strong></p><p>	•	Insertion: Adding new elements to the data structure.</p><p>	•	Deletion: Removing elements from the data structure.</p><p>	•	Traversal: Accessing and processing each element of the data structure.</p><p>	•	Searching: Finding an element within the data structure.</p><p>	•	Sorting: Arranging the elements in a particular order (e.g., ascending, descending).</p><p><br></p><p><strong>Advantages:</strong></p><p>	•	Efficient data management and retrieval.</p><p>	•	Improved performance of algorithms.</p><p>	•	Enables the implementation of complex functionalities and operations.</p><p><br></p><p><strong>Disadvantages:</strong></p><p>	•	Some data structures require more memory.</p><p>	•	Choosing the wrong data structure can lead to inefficient operations and increased complexity.</p><p>	•	Certain data structures may have complex implementation and maintenance.</p><p><br></p><p><strong>Use Cases:</strong></p><p>	•	Arrays and linked lists for basic data storage.</p><p>	•	Stacks and queues for order-based operations (e.g., LIFO and FIFO).</p><p>	•	Trees and graphs for hierarchical data and networked data.</p><p>	•	Hash tables for fast data retrieval based on keys.</p><p><br></p><p><strong>Comparison:</strong></p><p>Data structures are often compared based on their efficiency in performing operations like insertion, deletion, and searching. For example, arrays offer O(1) time complexity for accessing elements by index, whereas linked lists offer O(1) time complexity for insertion and deletion at the head.</p><p><br></p><p><strong>Key Takeaway:</strong></p><p>Data structures are essential for efficient data management and algorithm design. Understanding the strengths and limitations of different data structures is crucial for choosing the right one for a given problem, ensuring optimal performance and resource utilization.</p><p><br></p>', 'lecture', 1, '2024-08-04 08:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE `Courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_description` text DEFAULT NULL,
  `course_overview` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`course_id`, `course_name`, `course_description`, `course_overview`, `created_at`) VALUES
(1, 'Data Structures and Algorithms', 'An in-depth look at data structures and algorithms, covering various data types, their applications, and performance analysis.', '<h1>Data Structures and Algorithms (DSA) Course Overview</h1>\r\n    <h2>Course Name</h2>\r\n    <p><strong>Data Structures and Algorithms</strong></p>\r\n    <h2>Course Description</h2>\r\n    <p>An in-depth look at data structures and algorithms, covering various data types, their applications, and performance analysis. This course is designed to provide students with a strong foundation in essential data structures and algorithms used in computer science.</p>\r\n    <h2>Learning Outcomes</h2>\r\n    <p>By the end of this course, students will:</p>\r\n    <ul>\r\n        <li>Understand the fundamental concepts of data structures and algorithms.</li>\r\n        <li>Analyze the performance of algorithms in terms of time and space complexity.</li>\r\n        <li>Implement various data structures (e.g., arrays, linked lists, stacks, queues, trees, graphs) in Java.</li>\r\n        <li>Apply searching and sorting algorithms effectively.</li>\r\n        <li>Solve problems using recursive algorithms.</li>\r\n        <li>Utilize abstract data types (ADTs) and the Java Collections Framework.</li>\r\n        <li>Demonstrate the ability to tackle real-world problems through a final project.</li>\r\n    </ul>', '2024-07-23 18:28:28'),
(7, 'Calculus I', 'calculus', 'Over view', '2024-07-29 18:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `EnrolledCourses`
--

CREATE TABLE `EnrolledCourses` (
  `enrolled_course_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `progress` decimal(5,2) DEFAULT 0.00,
  `completed` tinyint(1) DEFAULT 0,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `EnrolledCourses`
--

INSERT INTO `EnrolledCourses` (`enrolled_course_id`, `user_id`, `course_id`, `progress`, `completed`, `enrolled_at`) VALUES
(3, 1, 1, '22.58', 0, '2024-07-26 18:03:48'),
(4, 3, 1, '6.45', 0, '2024-07-31 14:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `LearningStyles`
--

CREATE TABLE `LearningStyles` (
  `style_id` int(11) NOT NULL,
  `style_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LearningStyles`
--

INSERT INTO `LearningStyles` (`style_id`, `style_name`) VALUES
(1, 'Textbook Style'),
(2, 'Slides Style');

-- --------------------------------------------------------

--
-- Table structure for table `LSPossibleAnswers`
--

CREATE TABLE `LSPossibleAnswers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LSPossibleAnswers`
--

INSERT INTO `LSPossibleAnswers` (`answer_id`, `question_id`, `answer_text`) VALUES
(1, 2, 'Detailed descriptions'),
(2, 2, 'In-depth explanations'),
(3, 2, 'Summarized points'),
(4, 2, 'Visuals'),
(5, 3, 'Comprehensive chapters'),
(6, 3, 'Thorough explanations'),
(7, 3, 'Key points'),
(8, 3, 'Slides'),
(9, 4, 'Detailed notes'),
(10, 4, 'Highlighting'),
(11, 4, 'Summarizing'),
(12, 4, 'Key points'),
(13, 5, 'Narrative format'),
(14, 5, 'Examples'),
(15, 5, 'Concise sections'),
(16, 5, 'Summarized sections'),
(17, 6, 'Detailed explanations'),
(18, 6, 'Thorough concepts'),
(19, 6, 'Overview'),
(20, 6, 'Main points'),
(21, 7, 'Textbooks'),
(22, 7, 'Detailed articles'),
(23, 7, 'Slides'),
(24, 7, 'Infographics'),
(25, 8, 'Background'),
(26, 8, 'Context'),
(27, 8, 'Straight to the point'),
(28, 8, 'Essential information'),
(29, 9, 'Comprehensive background'),
(30, 9, 'Background information'),
(31, 9, 'Summary'),
(32, 9, 'Key points'),
(33, 1, 'Detailed explanations'),
(34, 1, 'In-depth explanations'),
(35, 1, 'Key concepts'),
(36, 1, 'Concise bullet points');

-- --------------------------------------------------------

--
-- Table structure for table `LSQuestions`
--

CREATE TABLE `LSQuestions` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LSQuestions`
--

INSERT INTO `LSQuestions` (`question_id`, `question_text`, `created_at`) VALUES
(1, 'How do you prefer information to be presented?', '2024-07-30 09:37:19'),
(2, 'Do you find it easier to learn from reading detailed descriptions and explanations, or from summarized points and visuals?', '2024-07-30 09:37:19'),
(3, 'When studying, do you prefer to read comprehensive chapters with thorough explanations, or to review slides with key points and diagrams?', '2024-07-30 09:37:19'),
(4, 'Do you like to take detailed notes while studying, or do you prefer to highlight and summarize key points?', '2024-07-30 09:37:19'),
(5, 'Do you find it easier to remember information when it\'s presented in a narrative format with examples, or when it\'s broken down into concise, summarized sections?', '2024-07-30 09:37:19'),
(6, 'When attending a lecture, do you prefer when the instructor goes into detail and explains concepts thoroughly, or when they provide an overview with the main points highlighted?', '2024-07-30 09:37:19'),
(7, 'Do you enjoy reading textbooks and detailed articles, or do you prefer looking at presentation slides and infographics?', '2024-07-30 09:37:19'),
(8, 'Are you more engaged when the material provides in-depth background and context, or when it gets straight to the point with essential information?', '2024-07-30 09:37:19'),
(9, 'Do you appreciate having comprehensive background information before diving into a topic, or do you prefer a summary of the key points right away?', '2024-07-30 09:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `LSResponses`
--

CREATE TABLE `LSResponses` (
  `response_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `MultipleChoiceQuestions`
--

CREATE TABLE `MultipleChoiceQuestions` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `choice1` text NOT NULL,
  `choice2` text NOT NULL,
  `choice3` text NOT NULL,
  `choice4` text NOT NULL,
  `correct_answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MultipleChoiceQuestions`
--

INSERT INTO `MultipleChoiceQuestions` (`question_id`, `question_text`, `topic_id`, `created_at`, `choice1`, `choice2`, `choice3`, `choice4`, `correct_answer`) VALUES
(1, 'What is the main objective of this course?', 1, '2024-07-27 18:55:35', 'Learn Java', 'Learn Python', 'Learn Data Structures', 'Learn Web Development', 'Learn Data Structures'),
(2, 'Who is the instructor of this course?', 1, '2024-07-27 18:55:35', 'John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Davis', 'John Doe'),
(3, 'Which of the following is a linear data structure?', 1, '2024-07-27 18:55:35', 'Array', 'Graph', 'Tree', 'Hash Table', 'Array'),
(4, 'Which of the following is a non-linear data structure?', 1, '2024-07-27 18:55:35', 'Linked List', 'Stack', 'Queue', 'Tree', 'Tree'),
(5, 'What is the default value of an uninitialized integer in Java?', 1, '2024-07-27 18:55:35', '0', '1', 'null', 'undefined', '0'),
(6, 'Which class is used to handle strings in Java?', 1, '2024-07-27 18:55:35', 'String', 'StringBuilder', 'StringBuffer', 'StringHandler', 'String'),
(7, 'How do you declare a two-dimensional array in Java?', 1, '2024-07-27 18:55:35', 'int[][] arr;', 'int arr[][];', 'int[2][] arr;', 'int[] arr[2];', 'int[][] arr;'),
(8, 'What is the default value of an array element in Java?', 1, '2024-07-27 18:55:35', '0', '1', 'null', 'undefined', '0'),
(9, 'What is data abstraction in Java?', 2, '2024-07-27 18:55:35', 'Hiding implementation details', 'Exposing implementation details', 'Hiding data', 'Exposing data', 'Hiding implementation details'),
(10, 'Which keyword is used for data abstraction in Java?', 2, '2024-07-27 18:55:35', 'abstract', 'extends', 'implements', 'interface', 'abstract'),
(11, 'What is an abstract class?', 2, '2024-07-27 18:55:35', 'A class that cannot be instantiated', 'A class that must be instantiated', 'A class without methods', 'A class with only static methods', 'A class that cannot be instantiated'),
(12, 'What is the purpose of an interface in Java?', 2, '2024-07-27 18:55:35', 'To define methods that can be implemented by multiple classes', 'To instantiate objects', 'To define a class', 'To handle exceptions', 'To define methods that can be implemented by multiple classes'),
(13, 'What does Big O notation describe?', 3, '2024-07-27 18:55:35', 'The worst-case time complexity of an algorithm', 'The best-case time complexity of an algorithm', 'The average-case time complexity of an algorithm', 'The space complexity of an algorithm', 'The worst-case time complexity of an algorithm'),
(14, 'What is the time complexity of binary search?', 3, '2024-07-27 18:55:35', 'O(log n)', 'O(n)', 'O(n log n)', 'O(1)', 'O(log n)'),
(15, 'What is the best case time complexity of linear search?', 3, '2024-07-27 18:55:35', 'O(1)', 'O(n)', 'O(log n)', 'O(n^2)', 'O(1)'),
(16, 'What is the worst case time complexity of bubble sort?', 3, '2024-07-27 18:55:35', 'O(n^2)', 'O(n)', 'O(log n)', 'O(n log n)', 'O(n^2)'),
(17, 'What does O(n) represent?', 3, '2024-07-27 18:55:35', 'Linear time complexity', 'Constant time complexity', 'Quadratic time complexity', 'Logarithmic time complexity', 'Linear time complexity'),
(18, 'What does Ω(n) represent?', 3, '2024-07-27 18:55:35', 'The lower bound of the time complexity', 'The upper bound of the time complexity', 'The average case time complexity', 'The worst case time complexity', 'The lower bound of the time complexity'),
(19, 'How do you insert an element at the beginning of a singly linked list?', 4, '2024-07-27 18:55:35', 'By updating the head to the new element', 'By updating the tail to the new element', 'By updating the middle element', 'By updating all elements', 'By updating the head to the new element'),
(20, 'How do you traverse a singly linked list?', 4, '2024-07-27 18:55:35', 'Starting from the head and moving to the next node until the end', 'Starting from the tail and moving to the previous node until the head', 'Starting from the middle and moving to both ends', 'Randomly accessing nodes', 'Starting from the head and moving to the next node until the end'),
(21, 'What is a key feature of a doubly linked list?', 4, '2024-07-27 18:55:35', 'Each node has a reference to both the next and previous nodes', 'Each node has a reference to only the next node', 'Each node has a reference to only the previous node', 'Each node has no references', 'Each node has a reference to both the next and previous nodes'),
(22, 'How do you delete an element from a doubly linked list?', 4, '2024-07-27 18:55:35', 'By updating the previous and next references of the neighboring nodes', 'By updating only the previous reference', 'By updating only the next reference', 'By updating the middle node', 'By updating the previous and next references of the neighboring nodes'),
(23, 'What is a circularly linked list?', 4, '2024-07-27 18:55:35', 'A linked list where the last node points back to the first node', 'A linked list where each node points to itself', 'A linked list where each node points to the previous node', 'A linked list with no head', 'A linked list where the last node points back to the first node'),
(24, 'What is the advantage of a circularly linked list?', 4, '2024-07-27 18:55:35', 'Efficient traversal from the end to the beginning', 'Simpler to implement', 'Uses less memory', 'Faster insertion at the end', 'Efficient traversal from the end to the beginning'),
(25, 'Which algorithm is used for searching in a sorted array?', 5, '2024-07-27 18:55:35', 'Binary search', 'Linear search', 'Jump search', 'Interpolation search', 'Binary search'),
(26, 'What is the time complexity of linear search?', 5, '2024-07-27 18:55:35', 'O(n)', 'O(log n)', 'O(n log n)', 'O(1)', 'O(n)'),
(27, 'What is the key difference between linear search and binary search?', 5, '2024-07-27 18:55:35', 'Binary search requires a sorted array', 'Linear search is faster', 'Binary search is slower', 'Binary search works on unsorted arrays', 'Binary search requires a sorted array'),
(28, 'What is the average case time complexity of binary search?', 5, '2024-07-27 18:55:35', 'O(log n)', 'O(n)', 'O(n log n)', 'O(1)', 'O(log n)'),
(29, 'What is hashing?', 5, '2024-07-27 18:55:35', 'A technique to convert a range of key values into a range of indexes', 'A technique to sort data', 'A technique to compress data', 'A technique to encrypt data', 'A technique to convert a range of key values into a range of indexes'),
(30, 'What is a hash table?', 5, '2024-07-27 18:55:35', 'A data structure that implements an associative array', 'A data structure for sorting', 'A data structure for compression', 'A data structure for encryption', 'A data structure that implements an associative array'),
(31, 'Which sorting algorithm is based on the divide and conquer principle?', 6, '2024-07-27 18:55:35', 'Merge sort', 'Bubble sort', 'Selection sort', 'Insertion sort', 'Merge sort'),
(32, 'What is the worst-case time complexity of quick sort?', 6, '2024-07-27 18:55:35', 'O(n^2)', 'O(n)', 'O(log n)', 'O(n log n)', 'O(n^2)'),
(33, 'What is the main advantage of insertion sort?', 6, '2024-07-27 18:55:35', 'Simple implementation', 'Best time complexity', 'Uses less memory', 'Efficient for large datasets', 'Simple implementation'),
(34, 'Which sorting algorithm selects the smallest element and swaps it with the first element?', 6, '2024-07-27 18:55:35', 'Selection sort', 'Insertion sort', 'Bubble sort', 'Merge sort', 'Selection sort'),
(35, 'What is the average time complexity of merge sort?', 6, '2024-07-27 18:55:35', 'O(n log n)', 'O(n)', 'O(n^2)', 'O(log n)', 'O(n log n)'),
(36, 'What is a key advantage of quick sort over merge sort?', 6, '2024-07-27 18:55:35', 'In-place sorting', 'Simpler implementation', 'Better worst-case time complexity', 'Uses less memory', 'In-place sorting'),
(37, 'What is recursion?', 7, '2024-07-27 18:55:35', 'A function calling itself', 'A function calling another function', 'A function that does not return', 'A function with a loop', 'A function calling itself'),
(38, 'What is the base case in recursion?', 7, '2024-07-27 18:55:35', 'The condition under which the recursion ends', 'The starting point of the recursion', 'A recursive call', 'A loop in the function', 'The condition under which the recursion ends'),
(39, 'What is the time complexity of a simple recursive algorithm for calculating factorial?', 7, '2024-07-27 18:55:35', 'O(n)', 'O(log n)', 'O(n^2)', 'O(1)', 'O(n)'),
(40, 'What is a key disadvantage of recursion?', 7, '2024-07-27 18:55:35', 'High memory usage', 'Low execution time', 'Complex implementation', 'Inability to solve problems', 'High memory usage'),
(41, 'What is an abstract data type (ADT)?', 7, '2024-07-27 18:55:35', 'A model for data structures', 'A specific implementation of a data structure', 'A data structure without data', 'A function without implementation', 'A model for data structures'),
(42, 'Which of the following is an example of an ADT?', 7, '2024-07-27 18:55:35', 'Stack', 'Array', 'Tree', 'Graph', 'Stack'),
(43, 'What is a stack?', 8, '2024-07-27 18:55:35', 'A data structure that follows LIFO', 'A data structure that follows FIFO', 'A data structure that follows LILO', 'A data structure that follows FILO', 'A data structure that follows LIFO'),
(44, 'Which operation is used to remove an element from the stack?', 8, '2024-07-27 18:55:35', 'Pop', 'Push', 'Peek', 'Insert', 'Pop'),
(45, 'Which data structure is commonly used in operating systems for process scheduling?', 8, '2024-07-27 18:55:35', 'Queue', 'Stack', 'Linked List', 'Tree', 'Queue'),
(46, 'What is a common application of a stack?', 8, '2024-07-27 18:55:35', 'Function calls', 'Network routing', 'File system navigation', 'Database indexing', 'Function calls'),
(47, 'What is a queue?', 9, '2024-07-27 18:55:35', 'A data structure that follows FIFO', 'A data structure that follows LIFO', 'A data structure that follows LILO', 'A data structure that follows FILO', 'A data structure that follows FIFO'),
(48, 'Which operation is used to remove an element from the queue?', 9, '2024-07-27 18:55:35', 'Dequeue', 'Enqueue', 'Peek', 'Insert', 'Dequeue'),
(49, 'Which data structure is commonly used in operating systems for process scheduling?', 9, '2024-07-27 18:55:35', 'Queue', 'Stack', 'Linked List', 'Tree', 'Queue'),
(50, 'What is a common application of a stack?', 9, '2024-07-27 18:55:35', 'Function calls', 'Network routing', 'File system navigation', 'Database indexing', 'Function calls');

-- --------------------------------------------------------

--
-- Table structure for table `Pretests`
--

CREATE TABLE `Pretests` (
  `pretest_id` int(11) NOT NULL,
  `pretest_question` text NOT NULL,
  `pretest_topic` int(11) NOT NULL,
  `pretest_course` int(1) NOT NULL,
  `answer_1` text NOT NULL,
  `answer_2` text NOT NULL,
  `answer_3` text NOT NULL,
  `answer_4` text NOT NULL,
  `correct_answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Pretests`
--

INSERT INTO `Pretests` (`pretest_id`, `pretest_question`, `pretest_topic`, `pretest_course`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `correct_answer`) VALUES
(1, 'What is a data structure?', 1, 1, 'A way to store and organize data', 'A type of algorithm', 'A programming language', 'A database', 'A way to store and organize data'),
(2, 'Which of the following is a linear data structure?', 1, 1, 'Graph', 'Array', 'Tree', 'Hash Table', 'Array'),
(3, 'Which data structure uses LIFO (Last In, First Out)?', 1, 1, 'Queue', 'Stack', 'Array', 'Linked List', 'Stack'),
(4, 'Which data structure uses FIFO (First In, First Out)?', 1, 1, 'Stack', 'Array', 'Queue', 'Tree', 'Queue'),
(5, 'What is a linked list?', 1, 1, 'A collection of nodes storing data and links to other nodes', 'A type of array', 'A function', 'An algorithm', 'A collection of nodes storing data and links to other nodes'),
(6, 'What is data abstraction?', 2, 1, 'A type of data structure', 'Hiding the implementation details', 'A programming language', 'An algorithm', 'Hiding the implementation details'),
(7, 'What is a class in OOP?', 2, 1, 'A blueprint for creating objects', 'A type of function', 'A data structure', 'A method', 'A blueprint for creating objects'),
(8, 'What is encapsulation in OOP?', 2, 1, 'Wrapping data and methods into a single unit', 'A type of data structure', 'A function', 'An algorithm', 'Wrapping data and methods into a single unit'),
(9, 'Which of the following is not a feature of OOP?', 2, 1, 'Inheritance', 'Encapsulation', 'Polymorphism', 'Recursion', 'Recursion'),
(10, 'What is an object in OOP?', 2, 1, 'An instance of a class', 'A type of function', 'A data structure', 'An algorithm', 'An instance of a class'),
(11, 'What is Big O notation?', 3, 1, 'A way to describe the efficiency of an algorithm', 'A type of algorithm', 'A data structure', 'A programming language', 'A way to describe the efficiency of an algorithm'),
(12, 'What is the time complexity of binary search?', 3, 1, 'O(n)', 'O(log n)', 'O(n^2)', 'O(1)', 'O(log n)'),
(13, 'Which of the following has the best time complexity for sorting?', 3, 1, 'Bubble sort', 'Insertion sort', 'Selection sort', 'Quick sort', 'Quick sort'),
(14, 'What is the space complexity of an algorithm?', 3, 1, 'The amount of memory it uses', 'The amount of time it takes', 'The number of steps it takes', 'The type of data it processes', 'The amount of memory it uses'),
(15, 'What is a heuristic algorithm?', 3, 1, 'An algorithm that finds a good enough solution', 'An algorithm that finds the best solution', 'A data structure', 'A programming language', 'An algorithm that finds a good enough solution'),
(16, 'What is a node in a linked list?', 4, 1, 'A basic unit containing data and a reference to the next node', 'A type of array', 'A function', 'An algorithm', 'A basic unit containing data and a reference to the next node'),
(17, 'Which of the following is true about singly linked lists?', 4, 1, 'They only have references to the next node', 'They have references to both the next and previous nodes', 'They are faster than arrays', 'They are always sorted', 'They only have references to the next node'),
(18, 'How do you add a node to the beginning of a linked list?', 4, 1, 'Update the head to point to the new node', 'Update the tail to point to the new node', 'Insert the node at the end', 'Delete the first node', 'Update the head to point to the new node'),
(19, 'What is the time complexity of searching in a linked list?', 4, 1, 'O(1)', 'O(n)', 'O(log n)', 'O(n^2)', 'O(n)'),
(20, 'What is a doubly linked list?', 4, 1, 'A list with references to both the next and previous nodes', 'A list with two heads', 'A type of array', 'A sorted list', 'A list with references to both the next and previous nodes'),
(21, 'What is linear search?', 5, 1, 'A search algorithm that checks each element sequentially', 'A search algorithm that divides the data in half', 'A recursive search algorithm', 'A sorting algorithm', 'A search algorithm that checks each element sequentially'),
(22, 'What is binary search?', 5, 1, 'A search algorithm that divides the data in half', 'A search algorithm that checks each element sequentially', 'A sorting algorithm', 'A data structure', 'A search algorithm that divides the data in half'),
(23, 'Which of the following is a requirement for using binary search?', 5, 1, 'The data must be sorted', 'The data must be unsorted', 'The data must be in a tree structure', 'The data must be in a linked list', 'The data must be sorted'),
(24, 'What is the time complexity of linear search?', 5, 1, 'O(n)', 'O(log n)', 'O(n^2)', 'O(1)', 'O(n)'),
(25, 'What is the time complexity of binary search?', 5, 1, 'O(log n)', 'O(n)', 'O(n^2)', 'O(1)', 'O(log n)'),
(26, 'What is bubble sort?', 6, 1, 'A simple sorting algorithm that repeatedly steps through the list', 'A divide and conquer algorithm', 'A search algorithm', 'A data structure', 'A simple sorting algorithm that repeatedly steps through the list'),
(27, 'What is quicksort?', 6, 1, 'A divide and conquer algorithm', 'A simple sorting algorithm that repeatedly steps through the list', 'A search algorithm', 'A data structure', 'A divide and conquer algorithm'),
(28, 'Which of the following sorting algorithms has the best average time complexity?', 6, 1, 'Quicksort', 'Bubble sort', 'Selection sort', 'Insertion sort', 'Quicksort'),
(29, 'What is the average time complexity of quicksort?', 6, 1, 'O(n log n)', 'O(n^2)', 'O(n)', 'O(log n)', 'O(n log n)'),
(30, 'What is merge sort?', 6, 1, 'A divide and conquer algorithm that divides the list into halves', 'A simple sorting algorithm that repeatedly steps through the list', 'A search algorithm', 'A data structure', 'A divide and conquer algorithm that divides the list into halves'),
(31, 'What is recursion?', 7, 1, 'A function that calls itself', 'A type of data structure', 'A sorting algorithm', 'A search algorithm', 'A function that calls itself'),
(32, 'What is a base case in recursion?', 7, 1, 'A condition that stops the recursion', 'A function that calls itself', 'A sorting algorithm', 'A search algorithm', 'A condition that stops the recursion'),
(33, 'Which of the following is an example of an abstract data type?', 7, 1, 'Stack', 'Array', 'Linked List', 'Tree', 'Stack'),
(34, 'What is an abstract data type?', 7, 1, 'A model for data structures that provides only the interface', 'A type of data structure', 'A sorting algorithm', 'A search algorithm', 'A model for data structures that provides only the interface'),
(35, 'What is a recursive algorithm?', 7, 1, 'An algorithm that calls itself with modified parameters', 'A type of data structure', 'A sorting algorithm', 'A search algorithm', 'An algorithm that calls itself with modified parameters'),
(36, 'What is a stack?', 8, 1, 'A data structure that follows LIFO (Last In, First Out)', 'A data structure that follows FIFO (First In, First Out)', 'A type of array', 'A type of list', 'A data structure that follows LIFO (Last In, First Out)'),
(37, 'What operation adds an element to a stack?', 8, 1, 'Push', 'Pop', 'Enqueue', 'Dequeue', 'Push'),
(38, 'What operation removes an element from a stack?', 8, 1, 'Pop', 'Push', 'Enqueue', 'Dequeue', 'Pop'),
(39, 'Which of the following applications use stacks?', 8, 1, 'Function call management in programming languages', 'Scheduling processes in an operating system', 'Storing elements in a queue', 'Managing elements in a linked list', 'Function call management in programming languages'),
(40, 'What is the time complexity of push and pop operations in a stack?', 8, 1, 'O(1)', 'O(n)', 'O(log n)', 'O(n^2)', 'O(1)'),
(41, 'What is a queue?', 9, 1, 'A data structure that follows FIFO (First In, First Out)', 'A data structure that follows LIFO (Last In, First Out)', 'A type of array', 'A type of list', 'A data structure that follows FIFO (First In, First Out)'),
(42, 'What operation adds an element to a queue?', 9, 1, 'Enqueue', 'Dequeue', 'Push', 'Pop', 'Enqueue'),
(43, 'What operation removes an element from a queue?', 9, 1, 'Dequeue', 'Enqueue', 'Push', 'Pop', 'Dequeue'),
(44, 'Which of the following applications use queues?', 9, 1, 'Scheduling processes in an operating system', 'Function call management in programming languages', 'Storing elements in a stack', 'Managing elements in a linked list', 'Scheduling processes in an operating system'),
(45, 'What is the time complexity of enqueue and dequeue operations in a queue?', 9, 1, 'O(1)', 'O(n)', 'O(log n)', 'O(n^2)', 'O(1)'),
(46, 'What is a binary tree?', 10, 1, 'A tree data structure in which each node has at most two children', 'A tree data structure in which each node has at most three children', 'A tree data structure in which each node has exactly two children', 'A tree data structure in which each node has at most one child', 'A tree data structure in which each node has at most two children'),
(47, 'What is a binary search tree?', 10, 1, 'A binary tree in which each node follows the left child < node < right child rule', 'A binary tree in which each node has exactly two children', 'A binary tree in which each node follows the left child > node > right child rule', 'A binary tree in which each node has at most one child', 'A binary tree in which each node follows the left child < node < right child rule'),
(48, 'What is an inorder traversal of a binary tree?', 10, 1, 'Visiting the left subtree, the root, and then the right subtree', 'Visiting the root, the left subtree, and then the right subtree', 'Visiting the left subtree, the right subtree, and then the root', 'Visiting the root, the right subtree, and then the left subtree', 'Visiting the left subtree, the root, and then the right subtree'),
(49, 'What is a balanced tree?', 10, 1, 'A tree in which the height of the left and right subtrees of any node differ by at most one', 'A tree in which each node has at most two children', 'A tree in which the height of the left and right subtrees of any node differ by at most two', 'A tree in which each node has exactly two children', 'A tree in which the height of the left and right subtrees of any node differ by at most one'),
(50, 'What is a complete binary tree?', 10, 1, 'A tree in which all levels except possibly the last are completely filled', 'A tree in which each node has at most two children', 'A tree in which each node has exactly two children', 'A tree in which all levels are completely filled', 'A tree in which all levels except possibly the last are completely filled'),
(51, 'What is a priority queue?', 11, 1, 'A data structure where each element has a priority', 'A data structure where each element has the same priority', 'A data structure where elements are stored in a queue', 'A data structure where elements are stored in a stack', 'A data structure where each element has a priority'),
(52, 'What is a graph?', 11, 1, 'A data structure that consists of a finite set of nodes and edges', 'A data structure that consists of a finite set of nodes and stacks', 'A data structure that consists of a finite set of nodes and arrays', 'A data structure that consists of a finite set of nodes and queues', 'A data structure that consists of a finite set of nodes and edges'),
(53, 'What is a directed graph?', 11, 1, 'A graph in which the edges have a direction', 'A graph in which the edges have no direction', 'A graph in which the nodes have a direction', 'A graph in which the nodes have no direction', 'A graph in which the edges have a direction'),
(54, 'What is an undirected graph?', 11, 1, 'A graph in which the edges have no direction', 'A graph in which the edges have a direction', 'A graph in which the nodes have a direction', 'A graph in which the nodes have no direction', 'A graph in which the edges have no direction'),
(55, 'What is the difference between a directed and an undirected graph?', 11, 1, 'In a directed graph, the edges have a direction; in an undirected graph, they do not', 'In a directed graph, the nodes have a direction; in an undirected graph, they do not', 'In a directed graph, the edges have no direction; in an undirected graph, they do', 'In a directed graph, the nodes have no direction; in an undirected graph, they do', 'In a directed graph, the edges have a direction; in an undirected graph, they do not'),
(56, 'What is a graph?', 12, 1, 'A data structure that consists of a finite set of nodes and edges', 'A data structure that consists of a finite set of nodes and stacks', 'A data structure that consists of a finite set of nodes and arrays', 'A data structure that consists of a finite set of nodes and queues', 'A data structure that consists of a finite set of nodes and edges'),
(57, 'What is a directed graph?', 12, 1, 'A graph in which the edges have a direction', 'A graph in which the edges have no direction', 'A graph in which the nodes have a direction', 'A graph in which the nodes have no direction', 'A graph in which the edges have a direction'),
(58, 'What is an undirected graph?', 12, 1, 'A graph in which the edges have no direction', 'A graph in which the edges have a direction', 'A graph in which the nodes have a direction', 'A graph in which the nodes have no direction', 'A graph in which the edges have no direction'),
(59, 'What is depth-first search (DFS)?', 12, 1, 'A graph traversal method that explores as far as possible along each branch before backtracking', 'A graph traversal method that explores the neighbors of each node before moving to the next level', 'A method for searching in trees', 'A method for searching in arrays', 'A graph traversal method that explores as far as possible along each branch before backtracking'),
(60, 'What is breadth-first search (BFS)?', 12, 1, 'A graph traversal method that explores the neighbors of each node before moving to the next level', 'A graph traversal method that explores as far as possible along each branch before backtracking', 'A method for searching in trees', 'A method for searching in arrays', 'A graph traversal method that explores the neighbors of each node before moving to the next level'),
(61, 'What is the Java Collections Framework?', 13, 1, 'A set of classes and interfaces that implement commonly reusable collection data structures', 'A set of algorithms for sorting and searching', 'A framework for developing Java applications', 'A library for creating graphical user interfaces', 'A set of classes and interfaces that implement commonly reusable collection data structures'),
(62, 'What is a List in the Java Collections Framework?', 13, 1, 'An ordered collection that allows duplicate elements', 'A collection that does not allow duplicate elements', 'A collection that maps keys to values', 'A collection that stores elements in a queue', 'An ordered collection that allows duplicate elements'),
(63, 'What is a Set in the Java Collections Framework?', 13, 1, 'A collection that does not allow duplicate elements', 'An ordered collection that allows duplicate elements', 'A collection that maps keys to values', 'A collection that stores elements in a queue', 'A collection that does not allow duplicate elements'),
(64, 'What is a Map in the Java Collections Framework?', 13, 1, 'A collection that maps keys to values', 'An ordered collection that allows duplicate elements', 'A collection that does not allow duplicate elements', 'A collection that stores elements in a queue', 'A collection that maps keys to values'),
(65, 'Which of the following is a concrete class in the Java Collections Framework?', 13, 1, 'ArrayList', 'List', 'Set', 'Map', 'ArrayList');

-- --------------------------------------------------------

--
-- Table structure for table `QuizResults`
--

CREATE TABLE `QuizResults` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `taken_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `QuizResults`
--

INSERT INTO `QuizResults` (`result_id`, `user_id`, `topic_id`, `score`, `taken_at`) VALUES
(11, 1, 1, 2, '2024-07-28 02:21:47'),
(12, 1, 1, 1, '2024-07-28 11:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `SavedCourses`
--

CREATE TABLE `SavedCourses` (
  `saved_course_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SavedCourses`
--

INSERT INTO `SavedCourses` (`saved_course_id`, `user_id`, `course_id`, `saved_at`) VALUES
(21, 1, 1, '2024-07-25 15:09:21'),
(22, 3, 1, '2024-07-31 14:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `Subtopics`
--

CREATE TABLE `Subtopics` (
  `subtopic_id` int(11) NOT NULL,
  `subtopic_name` varchar(100) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Subtopics`
--

INSERT INTO `Subtopics` (`subtopic_id`, `subtopic_name`, `topic_id`, `created_at`) VALUES
(1, 'Introduction', 1, '2024-07-23 18:33:02'),
(3, 'Simple Data Structures in Java: Variables, Strings, Enums', 1, '2024-07-23 18:33:02'),
(4, 'Linear and Multi-dimensional Arrays', 1, '2024-07-23 18:33:02'),
(5, 'Revisiting the Concept of Data Abstraction', 2, '2024-07-23 18:33:02'),
(6, 'Classes and Objects, Interfaces, Abstract Classes, Generics', 2, '2024-07-23 18:33:02'),
(7, 'Algorithm Analysis: Time Complexity and Space Complexity', 3, '2024-07-23 18:33:02'),
(8, 'Running Time Calculations: Best Case, Worst Case, Average Case', 3, '2024-07-23 18:33:02'),
(9, 'Asymptotic Analysis (O, Ω, Θ)', 3, '2024-07-23 18:33:02'),
(10, 'Singly Linked List', 4, '2024-07-23 18:33:02'),
(11, 'Doubly Linked List', 4, '2024-07-23 18:33:02'),
(12, 'Circularly Linked List', 4, '2024-07-23 18:33:02'),
(13, 'Searching Algorithms: Common Types', 5, '2024-07-23 18:33:02'),
(14, 'Linear Search and Binary Search, Time Complexity', 5, '2024-07-23 18:33:02'),
(15, 'Hashing and Hash Table', 5, '2024-07-23 18:33:02'),
(16, 'Sorting Algorithms: Common Types', 6, '2024-07-23 18:33:02'),
(17, 'Insertion Sort, Selection Sort, Time Complexity', 6, '2024-07-23 18:33:02'),
(18, 'Sorting Algorithms: Merge Sort, Quick Sort, Time Complexity', 6, '2024-07-23 18:33:02'),
(19, 'Recursion: Writing Recursive Algorithms', 7, '2024-07-23 18:33:02'),
(20, 'Analysis of Recursive Algorithms', 7, '2024-07-23 18:33:02'),
(21, 'Abstract Data Type (ADT): ADTs of List, Stack, Queue, Set, Tree, Priority Queues, Graph, Hash Table', 7, '2024-07-23 18:33:02'),
(22, 'Stack ADT', 8, '2024-07-23 18:33:02'),
(23, 'Applications of Stacks', 8, '2024-07-23 18:33:02'),
(24, 'Queue ADT', 9, '2024-07-23 18:33:02'),
(25, 'Applications of Queues', 9, '2024-07-23 18:33:02'),
(26, 'Trees: Terminology, Traversals, Binary Trees, Applications', 10, '2024-07-23 18:33:02'),
(27, 'Binary Search Tree ADT, AVL Trees', 10, '2024-07-23 18:33:02'),
(28, 'Priority Queues (Heaps)', 11, '2024-07-23 18:33:02'),
(29, 'Applications', 11, '2024-07-23 18:33:02'),
(30, 'Graph ADT: Representation, Graph Traversals, Applications', 12, '2024-07-23 18:33:02'),
(31, 'Graphs: Shortest Path, Minimum Spanning Tree', 12, '2024-07-23 18:33:02'),
(32, 'Review of Java Collections Framework', 13, '2024-07-23 18:33:02'),
(35, 'dy/dx', 16, '2024-07-29 18:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `Topics`
--

CREATE TABLE `Topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(100) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Topics`
--

INSERT INTO `Topics` (`topic_id`, `topic_name`, `course_id`, `created_at`) VALUES
(1, 'Introduction to Data Structures', 1, '2024-07-23 18:32:25'),
(2, 'Data Abstraction and Classes', 1, '2024-07-23 18:32:25'),
(3, 'Algorithm Analysis', 1, '2024-07-23 18:32:25'),
(4, 'Linked Lists', 1, '2024-07-23 18:32:25'),
(5, 'Searching Algorithms', 1, '2024-07-23 18:32:25'),
(6, 'Sorting Algorithms', 1, '2024-07-23 18:32:25'),
(7, 'Recursion and Abstract Data Types', 1, '2024-07-23 18:32:25'),
(8, 'Stacks', 1, '2024-07-23 18:32:25'),
(9, 'Queues', 1, '2024-07-23 18:32:25'),
(10, 'Trees', 1, '2024-07-23 18:32:25'),
(11, 'Priority Queues and Graphs', 1, '2024-07-23 18:32:25'),
(12, 'Graphs', 1, '2024-07-23 18:32:25'),
(13, 'Java Collections Framework', 1, '2024-07-23 18:32:25'),
(16, 'Differentiation', 7, '2024-07-29 18:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `UserAchievements`
--

CREATE TABLE `UserAchievements` (
  `user_achievement_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `achievement_id` int(11) DEFAULT NULL,
  `achieved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `UserAnswers`
--

CREATE TABLE `UserAnswers` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_choice` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `result_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UserAnswers`
--

INSERT INTO `UserAnswers` (`answer_id`, `user_id`, `question_id`, `selected_choice`, `is_correct`, `created_at`, `result_id`) VALUES
(24, 1, 1, 'Learn Java', 0, '2024-07-28 02:21:47', 11),
(25, 1, 2, 'Michael Johnson', 0, '2024-07-28 02:21:47', 11),
(26, 1, 3, 'Graph', 0, '2024-07-28 02:21:47', 11),
(27, 1, 4, 'Tree', 1, '2024-07-28 02:21:47', 11),
(28, 1, 5, '0', 1, '2024-07-28 02:21:47', 11),
(29, 1, 6, 'StringBuffer', 0, '2024-07-28 02:21:47', 11),
(30, 1, 7, 'int arr[][];', 0, '2024-07-28 02:21:47', 11),
(31, 1, 8, 'null', 0, '2024-07-28 02:21:47', 11),
(32, 1, 1, 'Learn Data Structures', 1, '2024-07-28 11:56:14', 12),
(33, 1, 2, 'Michael Johnson', 0, '2024-07-28 11:56:14', 12),
(34, 1, 3, 'Graph', 0, '2024-07-28 11:56:14', 12),
(35, 1, 4, 'Queue', 0, '2024-07-28 11:56:14', 12),
(36, 1, 5, 'undefined', 0, '2024-07-28 11:56:14', 12),
(37, 1, 6, 'StringBuffer', 0, '2024-07-28 11:56:14', 12),
(38, 1, 7, 'int[2][] arr;', 0, '2024-07-28 11:56:14', 12),
(39, 1, 8, 'null', 0, '2024-07-28 11:56:14', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_role` int(1) NOT NULL DEFAULT 1,
  `user_style` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `password`, `email`, `first_name`, `last_name`, `created_at`, `user_role`, `user_style`) VALUES
(1, '$2y$10$jLgQNd4DbM5DH2FU0Y4U2O3pxrAgjlRuEPkwD5VD/6lwCVFyZ.BJ6', 'nana.djan@ashesi.edu.gh', 'Nana Kofi', 'Djan', '2024-07-23 19:46:06', 1, 1),
(3, '$2y$10$AzNXE8hafL9yWMCneFmyIeDt8wZV5FPM02w6WK5/xuH04FHiwjQIa', 'admin@admin.com', 'admin', 'admin', '2024-07-29 00:37:42', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `UsersTopics`
--

CREATE TABLE `UsersTopics` (
  `usertopics_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `course_id` int(1) NOT NULL,
  `subtopic_status` int(1) NOT NULL DEFAULT 0,
  `subtopic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UsersTopics`
--

INSERT INTO `UsersTopics` (`usertopics_id`, `user_id`, `topic_id`, `course_id`, `subtopic_status`, `subtopic_id`) VALUES
(39, 1, 1, 1, 1, 1),
(40, 1, 1, 1, 1, 2),
(41, 1, 1, 1, 1, 3),
(42, 1, 1, 1, 1, 4),
(43, 1, 2, 1, 1, 5),
(44, 1, 2, 1, 0, 6),
(45, 1, 3, 1, 1, 7),
(46, 1, 3, 1, 0, 8),
(47, 1, 3, 1, 0, 9),
(48, 1, 4, 1, 0, 10),
(49, 1, 4, 1, 0, 11),
(50, 1, 4, 1, 0, 12),
(51, 1, 5, 1, 0, 13),
(52, 1, 5, 1, 0, 14),
(53, 1, 5, 1, 0, 15),
(54, 1, 6, 1, 0, 16),
(55, 1, 6, 1, 0, 17),
(56, 1, 6, 1, 0, 18),
(57, 1, 7, 1, 0, 19),
(58, 1, 7, 1, 0, 20),
(59, 1, 7, 1, 0, 21),
(60, 1, 8, 1, 0, 22),
(61, 1, 8, 1, 0, 23),
(62, 1, 9, 1, 0, 24),
(63, 1, 9, 1, 0, 25),
(64, 1, 10, 1, 0, 26),
(65, 1, 10, 1, 0, 27),
(66, 1, 11, 1, 0, 28),
(67, 1, 11, 1, 0, 29),
(68, 1, 12, 1, 0, 30),
(69, 1, 12, 1, 0, 31),
(70, 1, 13, 1, 1, 32),
(71, 3, 13, 1, 1, 32),
(72, 3, 1, 1, 1, 1),
(73, 3, 1, 1, 1, 4),
(74, 3, 1, 1, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Achievements`
--
ALTER TABLE `Achievements`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Indexes for table `AvailableCourses`
--
ALTER TABLE `AvailableCourses`
  ADD PRIMARY KEY (`available_course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `Content`
--
ALTER TABLE `Content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `subtopic_id` (`subtopic_id`);

--
-- Indexes for table `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `EnrolledCourses`
--
ALTER TABLE `EnrolledCourses`
  ADD PRIMARY KEY (`enrolled_course_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `LearningStyles`
--
ALTER TABLE `LearningStyles`
  ADD PRIMARY KEY (`style_id`);

--
-- Indexes for table `LSPossibleAnswers`
--
ALTER TABLE `LSPossibleAnswers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `LSQuestions`
--
ALTER TABLE `LSQuestions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `LSResponses`
--
ALTER TABLE `LSResponses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Indexes for table `MultipleChoiceQuestions`
--
ALTER TABLE `MultipleChoiceQuestions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `Pretests`
--
ALTER TABLE `Pretests`
  ADD PRIMARY KEY (`pretest_id`),
  ADD KEY `pretest_topic` (`pretest_topic`);

--
-- Indexes for table `QuizResults`
--
ALTER TABLE `QuizResults`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `SavedCourses`
--
ALTER TABLE `SavedCourses`
  ADD PRIMARY KEY (`saved_course_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `Subtopics`
--
ALTER TABLE `Subtopics`
  ADD PRIMARY KEY (`subtopic_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `Topics`
--
ALTER TABLE `Topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `UserAchievements`
--
ALTER TABLE `UserAchievements`
  ADD PRIMARY KEY (`user_achievement_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `achievement_id` (`achievement_id`);

--
-- Indexes for table `UserAnswers`
--
ALTER TABLE `UserAnswers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `UsersTopics`
--
ALTER TABLE `UsersTopics`
  ADD PRIMARY KEY (`usertopics_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Achievements`
--
ALTER TABLE `Achievements`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `AvailableCourses`
--
ALTER TABLE `AvailableCourses`
  MODIFY `available_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Content`
--
ALTER TABLE `Content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Courses`
--
ALTER TABLE `Courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `EnrolledCourses`
--
ALTER TABLE `EnrolledCourses`
  MODIFY `enrolled_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `LearningStyles`
--
ALTER TABLE `LearningStyles`
  MODIFY `style_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `LSPossibleAnswers`
--
ALTER TABLE `LSPossibleAnswers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `LSQuestions`
--
ALTER TABLE `LSQuestions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `LSResponses`
--
ALTER TABLE `LSResponses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `MultipleChoiceQuestions`
--
ALTER TABLE `MultipleChoiceQuestions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `Pretests`
--
ALTER TABLE `Pretests`
  MODIFY `pretest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `QuizResults`
--
ALTER TABLE `QuizResults`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `SavedCourses`
--
ALTER TABLE `SavedCourses`
  MODIFY `saved_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Subtopics`
--
ALTER TABLE `Subtopics`
  MODIFY `subtopic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `Topics`
--
ALTER TABLE `Topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `UserAchievements`
--
ALTER TABLE `UserAchievements`
  MODIFY `user_achievement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserAnswers`
--
ALTER TABLE `UserAnswers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `UsersTopics`
--
ALTER TABLE `UsersTopics`
  MODIFY `usertopics_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AvailableCourses`
--
ALTER TABLE `AvailableCourses`
  ADD CONSTRAINT `availablecourses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `Content`
--
ALTER TABLE `Content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`subtopic_id`) REFERENCES `Subtopics` (`subtopic_id`) ON DELETE CASCADE;

--
-- Constraints for table `EnrolledCourses`
--
ALTER TABLE `EnrolledCourses`
  ADD CONSTRAINT `enrolledcourses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrolledcourses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `LSPossibleAnswers`
--
ALTER TABLE `LSPossibleAnswers`
  ADD CONSTRAINT `lspossibleanswers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `LSQuestions` (`question_id`);

--
-- Constraints for table `LSResponses`
--
ALTER TABLE `LSResponses`
  ADD CONSTRAINT `lsresponses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `lsresponses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `LSQuestions` (`question_id`),
  ADD CONSTRAINT `lsresponses_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `LSPossibleAnswers` (`answer_id`);

--
-- Constraints for table `MultipleChoiceQuestions`
--
ALTER TABLE `MultipleChoiceQuestions`
  ADD CONSTRAINT `multiplechoicequestions_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `Topics` (`topic_id`) ON DELETE CASCADE;

--
-- Constraints for table `Pretests`
--
ALTER TABLE `Pretests`
  ADD CONSTRAINT `pretests_ibfk_1` FOREIGN KEY (`pretest_topic`) REFERENCES `Topics` (`topic_id`);

--
-- Constraints for table `QuizResults`
--
ALTER TABLE `QuizResults`
  ADD CONSTRAINT `quizresults_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizresults_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `Topics` (`topic_id`) ON DELETE CASCADE;

--
-- Constraints for table `SavedCourses`
--
ALTER TABLE `SavedCourses`
  ADD CONSTRAINT `savedcourses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `savedcourses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `Subtopics`
--
ALTER TABLE `Subtopics`
  ADD CONSTRAINT `subtopics_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `Topics` (`topic_id`) ON DELETE CASCADE;

--
-- Constraints for table `Topics`
--
ALTER TABLE `Topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `UserAchievements`
--
ALTER TABLE `UserAchievements`
  ADD CONSTRAINT `userachievements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userachievements_ibfk_2` FOREIGN KEY (`achievement_id`) REFERENCES `Achievements` (`achievement_id`) ON DELETE CASCADE;

--
-- Constraints for table `UserAnswers`
--
ALTER TABLE `UserAnswers`
  ADD CONSTRAINT `useranswers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `useranswers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `MultipleChoiceQuestions` (`question_id`);

--
-- Constraints for table `UsersTopics`
--
ALTER TABLE `UsersTopics`
  ADD CONSTRAINT `userstopics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `userstopics_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `Topics` (`topic_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
