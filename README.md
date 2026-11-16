Laravel Job Board

A web-based job board application built with Laravel 12, allowing candidates to browse job offers and apply for positions, while employers can publish and manage their job listings.
The project was created as an educational project to practice web application development using Laravel and modern frontend technologies.

Features

For Candidates
User registration and login
Browse available job offers
Search for job offers
View job details
Apply for jobs
Upload a CV in PDF format
Track application status
View submitted applications
For Employers
Employer registration and login
Create job offers
Edit and delete own job offers
View applications submitted by candidates
Access uploaded CV files
Accept or reject applications
General
Job search functionality
Job categories and tags
Featured job listings
Pagination
Role-based access for candidates and employers

Technologies

Backend: PHP 8.2+, Laravel 12
Frontend: Blade, Tailwind CSS, JavaScript
Database: SQLite
Build tool: Vite

Dependency management: Composer, npm

Screenshots

Screenshots of the application will be added here.

<!-- Add screenshots here once they are uploaded to the repository. -->

Installation

Follow these steps to run the project locally.

1. Clone the repository

git clone https://github.com/Sliwa184/laravel-job-board.git
cd laravel-job-board

2. Install dependencies

composer install
npm install

3. Configure the environment

Create your local environment file:

cp .env.example .env

Generate the application key:

php artisan key:generate

Make sure the following database configuration is set in your .env file:

DB_CONNECTION=sqlite

4. Create the SQLite database

Create an empty file named database.sqlite inside the database directory.

5. Run migrations

php artisan migrate

6. Create the storage link

php artisan storage:link

7. Build frontend assets

npm run build

8. Start the development server

php artisan serve

The application should now be available at:

http://127.0.0.1:8000

For frontend development with Vite, run npm run dev in a separate terminal.

Project Purpose

This project was developed to gain practical experience in building a full-stack web application, working with Laravel, database relationships, authentication, file uploads, authorization and frontend styling.
