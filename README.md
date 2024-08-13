# ATTA - Intelligent Tutoring System

This repository contains the source code for the **ATTA** project, an AI-powered Intelligent Tutoring System (ITS) designed to address educational challenges in developing African countries like Ghana. The system utilizes a Large Language Model (LLM) to provide personalized learning experiences for students, adapting content based on their preferences and knowledge levels.

## Abstract

Education provision in developing African countries like Ghana is frequently hindered by recurring obstacles such as insufficient resources to meet the high demand for education. This impacts both faculty and students, as the latter often struggle to receive in-depth assistance due to time constraints. ATTA addresses these challenges by leveraging the potential of personalized learning through an AI-powered ITS.

Key features of the system include:
- Personalized content generation tailored to individual learning preferences and knowledge levels.
- An AI chatbot for real-time support.
- Post-session assessments to track and enhance learning outcomes.

This project also seeks to initiate a conversation on the widespread adoption of such systems in educational institutions in Ghana and other developing regions. By integrating personalized instruction and adaptive learning paths, ATTA aims to improve student comprehension and retention of course material.

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:

- **PHP 7.x or higher**
- **MySQL** (or MariaDB)
- **Apache or Nginx** server
- **Composer** (for dependency management)
- **Git**

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Ashesi-Org/ATTA.git
   ```
2. **Navigate to the project directory:**

   ```bash
   cd ATTA
   ```
3. **Install dependencies:**

   If your project uses Composer, run:

   ```bash
   composer install
   ```
4. **Set up the database:**

   - Create a MySQL database for the project.
   - Import the database schema using the provided SQL file (if available) or set up the necessary tables as per the application's requirements.

   ```bash
   # Command to set up the database
   mysql -u localhost -p ITS < Database/schema.sql
   ```
5. **Run the application:**

   - If using Apache, ensure your virtual host is configured correctly.
   - If using a built-in PHP server, you can start the server with:

   ```bash
   php -S localhost:8000 -t public
   ```
6. **Access the application:**

   - Open your web browser and navigate to:
   ```bash
   http://localhost:8000
   ```
    - Replace `8000` with the port number if different.

## Features

- **Personalized Learning Paths:** Tailored content based on individual student preferences and knowledge levels.
- **AI Chatbot:** Real-time assistance for students during their learning journey.
- **Post-Session Assessments:** Evaluate student performance and adjust learning materials accordingly.

## Usage

1. **Accessing the system:**

Open your web browser and navigate to:
```bash
http://localhost:8000
```

2. **Logging in:**

Use the provided credentials or sign up as a new user to start interacting with the system.
- Admin User: admin@admin.com(Nanabanyin@1)

3. **Exploring the Features:**

- **Content Generation:** Navigate to the learning modules to access personalized content.
- **AI Chatbot:** Use the chatbot for instant support.
- **Assessments:** Complete the post-session quizzes to track your learning progress.

## Troubleshooting

- **Database Connection Issues:** Ensure your database credentials are correct and the MySQL service is running.
- **Server Errors:** Check the server logs for detailed error messages and ensure all dependencies are installed.

## Future Enhancements

- Improve user profiling to better tailor the content.
- Expand the diversity of assessments to cover more learning styles.
- Explore the deployment of the system to a broader audience.

## Contributing

To contribute to this project, follow these steps:

1. Fork this repository.
2. Create a new branch: `git checkout -b feature/your-feature`.
3. Make your changes and commit them: `git commit -m 'Add some feature'`.
4. Push to the original branch: `git push origin feature/your-feature`.
5. Create the pull request.
