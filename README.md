# HR Management System

A Human Resources Management System built with Laravel.

## Requirements

* PHP 8.3 or higher
* Composer 2.x
* Node.js & npm
* MySQL

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd <project-folder>
```

> Replace `<project-folder>` with the folder name created after cloning.

### 2. Create the Environment File

```bash
copy .env.example .env
```

### 3. Configure the Database

Open the `.env` file and configure your local MySQL database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hr_system
DB_USERNAME=root
DB_PASSWORD=
```

> Each team member should use their own local database and `.env` file.

### 4. Run the Setup

The project includes a setup script that automatically:

* Installs PHP dependencies
* Generates the application key
* Runs database migrations
* Installs frontend dependencies
* Builds the frontend assets

So Just Run:

```bash
composer run setup
```

### 5. Start the Application

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

## Important Notes

* Do **not** upload `.env` to GitHub.
* Each team member should have their own `.env` and local database.
* `composer.lock` should be committed to the repository.
* `package-lock.json` should be committed to the repository.
* Do **not** run `composer update` unless the team agrees to update the project's dependencies.
* Use `composer install` when installing the project's existing dependencies.
