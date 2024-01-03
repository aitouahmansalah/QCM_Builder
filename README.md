QCM Web App
QCM Web App is a web application designed to facilitate the creation and management of multiple-choice exams. It provides a platform for both professors and students to interact with exams in a user-friendly manner.

#Features:

#User Authentication:
Registration: Users can create accounts by providing necessary details.
Login/Logout: Authenticated users can log in and log out of their accounts.


#Professor Features:
Create Exams: Professors can create exams with multiple questions and options.
Manage Exams: Professors can view and manage exams they have created.
View Results: Professors have the ability to view detailed results of exams.


#Student Features:
View Exams: Students can see a list of available exams.
Attempt Exams: Students can attempt exams with multiple-choice questions.
Receive Scores: Students receive scores upon completing an exam.


#Technologies Used :
The project is built using the following technologies:

Laravel: A PHP web application framework.
Bootstrap: A popular front-end framework for building responsive and visually appealing web pages.
MySQL: Database management system for storing exam-related data.


#Installation:
Clone the Repository:
git clone https://github.com/yourusername/qcm-web-app.git

Change into the Project Directory:
cd qcm-web-app

Install Dependencies:
composer install

Generate Application Key:
php artisan key:generate

Migrate the Database:
php artisan migrate

Run the Development Server:

php artisan serve

Open your browser and visit http://localhost:8000.

#Usage:
User Registration/Login:

Register for a new account or log in if you already have an account.
Professor Actions:

Professors can create exams, manage them, and view detailed results.
Student Actions:

Students can view available exams, attempt them, and view their scores.

#Contributing:
Contributions are welcome! If you find a bug or have a feature request, please open an issue or submit a pull request.