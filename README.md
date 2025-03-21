Laravel 12 Repository Pattern Template
This project is a Laravel 12-based template that follows the Repository Pattern to maintain clean and structured code. It includes essential features such as authentication, logging, and API documentation.

Features:
Repository Pattern: Implements a clear separation between the data access layer and business logic.
Authentication Module: Built-in authentication system for secure access control.
Role-Based Access Control (RBAC): Manage user roles and permissions efficiently.
Logging System: Integrated with Laravel Log Viewer by Rap2h for easy log management.
API Documentation: Uses Swagger (L5 Swagger) to generate and maintain API documentation.
Multi-role Support: Users can have multiple roles, with access control handled dynamically.
Installation:
Clone the repository:

sh
Copy
Edit
git clone <repo-url>
cd <project-folder>
Install dependencies:

sh
Copy
Edit
composer install
Set up the environment:

sh
Copy
Edit
cp .env.example .env
php artisan key:generate
Configure the database in .env and run migrations:

sh
Copy
Edit
php artisan migrate --seed
Start the development server:

sh
Copy
Edit
php artisan serve
