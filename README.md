# xans task manager

Personal task manager built with Laravel, Blade, and Tailwind CSS.

## Project Information

- **Project Code:** WST21-PM-2026-SF
- **Student Name:** Christian Vann A. Soronio
- **Course & Year:** BSIT-2 SEC 11
- **Database Used:** SQLite by default, with MySQL support

## Features

- Add, view, edit, and delete tasks
- Mark tasks as pending or completed
- Show overdue tasks
- Shared task workspace without login
- Responsive purple dashboard
- Server-side validation and CSRF protection

## Requirements

- PHP 8.2 or later
- Composer
- SQLite with the PDO SQLite extension, or MySQL 8+

## Installation

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

Tailwind CSS is loaded through its CDN, so Node.js is not required.

## MySQL Setup

Create a database named `daymark`, then update these values in `.env`:

```env
DB_CONNECTION=mysql
DB_DATABASE=daymark
DB_USERNAME=root
DB_PASSWORD=
```

## Main Laravel Files

- `routes/web.php` contains the application routes.
- `app/Http/Controllers/TaskController.php` handles task operations.
- `app/Models/Task.php` defines the task model.
- `resources/views/tasks` contains the task dashboard and edit page.
