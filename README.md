# Hotel with Room Reservations

## Project Description

This project is a web application for a hotel with room reservation functionality. Registered users can reserve rooms and view their reservation details. Administrators can post news articles, which will be visible in a dedicated area of the website. Anonymous users can view the news articles posted by administrators without logging in.

The project was created as part of a first semester web technologies course and focuses on user roles, database management, and other key features.

## Technologies Used

The following technologies were used to develop the project:

- Bootstrap
- HTML
- CSS
- PHP
- MySQLi (for database access)
- PHPMyAdmin (for managing MySQL database)

## Custom Framework and Architecture

Since we were not allowed to use any existing PHP frameworks with MVC pattern, a custom framework was developed for this project. The framework consists of base classes for:

- Controller
- Model
- Service
- Database

Additionally, a core engine was implemented to manage the application's logic. The architecture also includes a separate controller, model, and service layer for the admin functionality.

## Installation Instructions

To set up the project, follow these steps:

1. Download the project source files.
2. Place the downloaded files in your web server's document root (e.g., `htdocs` for Apache).
3. Create a new database in your MySQL server.
4. Edit the configuration file to update the database connection details.
5. Import the data from the provided SQL file into your newly created database.
