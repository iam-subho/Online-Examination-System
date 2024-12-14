# SmartQuest Quiz Management System

SmartQuest is a comprehensive, open-source quiz management system designed to facilitate the creation, administration, and analysis of quizzes and assessments. Built with modern web technologies, it offers a user-friendly interface and robust features suitable for educational institutions, corporate training, and individual educators.

## Features

- **User-Friendly Interface**: Intuitive design ensuring ease of use for administrators and participants.
- **Customizable Quizzes**: Create quizzes with various question types, including multiple-choice, true/false, and short answer.
- **Question Bank**: Organize and reuse questions across multiple quizzes.
- **Timed Assessments**: Set time limits to enhance assessment integrity.
- **Randomization**: Shuffle questions and answer options to minimize cheating.
- **Analytics and Reporting**: Gain insights into performance with detailed reports and statistics.
- **Responsive Design**: Accessible on desktops, tablets, and mobile devices.

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/iam-subho/SmartQuest-Quize.git

2. **Navigate to the Project Directory:**:
   ```bash
   cd SmartQuest-Quize

3. **Install Dependencies:**:
   ```bash
   composer install
   npm install 

4. **Install Dependencies:**:
 - **Duplicate .env.example and rename it to .env.
   Update database credentials and other necessary configurations in the .env file.**   

5. **Generate Application Key:**:
   ```bash
      php artisan key:generate
   
6. **Run Migrations:**:
   ```bash
      php artisan migrate

7. **Start the Development Server:**:
   ```bash
      php artisan serve 

## Usage

- **Admin Panel**: Manage quizzes, questions, and users through the admin dashboard.
- **Quiz Creation**: Utilize the question bank to design customized quizzes.
- **Participant Engagement**: Invite users to participate in quizzes and monitor their progress.
- **Performance Analysis**: Review detailed analytics to assess participant performance and quiz effectiveness.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your enhancements or bug fixes. Ensure your code adheres to the project's coding standards and includes appropriate tests.
