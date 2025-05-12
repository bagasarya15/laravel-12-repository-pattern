# 🚀 Laravel 12 Repository Pattern

A **scalable, clean, and modular** Laravel 12 boilerplate implementing the **Repository Pattern**, with built-in authentication, logging, and API documentation. Designed for maintainability and best practices in modern web application development.

---

## 🛠️ Features

✅ **Repository Pattern** – Separates business logic from database queries for cleaner code.  
✅ **Authentication Module** – Secure user authentication with role-based access.  
✅ **Role-Based Access Control (RBAC)** – Multi-role support for dynamic permission handling.  
✅ **Logging System** – Integrated with **Laravel Log Viewer by Rap2h** for seamless log management.
✅ **Multi-Role Support** – Users can have multiple roles, ensuring flexible access control.  
✅ **Scalable Architecture** – Designed for large-scale applications with modular and reusable components.

---

## 📦 Installation

Follow these steps to set up the project:

```sh
# Clone the repository
git clone <repo-url>
cd <project-folder>

# Install dependencies
composer install

# Set up environment variables
cp .env.example .env
php artisan key:generate

# Configure database and run migrations
php artisan migrate --seed

# Start the development server
php artisan serve
```

---

## 🔐 Authentication & Role Management

-   **RBAC System:** Users have multiple roles and permissions.
-   **Middleware-based Authorization:** Protect routes using custom middleware.
-   **Authentication:** Handled via Laravel Sanctum.

Example middleware usage:

```php
Route::prefix("master")
  ->middleware(['auth:sanctum'])
  ->group(function () {
    Route::apiResource("role", RoleController::class)
      ->except(["show"])
      ->middleware('role.access');
  });
```

---

## 📄 Log Management

Laravel Log Viewer by Rap2h is included for real-time log monitoring.

-   View logs at: `/logs`
-   Ensure logging is configured in `config/logging.php`
