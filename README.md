# HRPulse — Human Resources Management System

HRPulse is a web-based Human Resources Management System built with Laravel and MySQL.  
The system provides a centralized platform for managing employees, departments, positions, salaries, attendance, leave requests, roles, permissions, and user profiles.

The project was developed as part of the NTI Full Stack Web Development training using PHP and Laravel.

---

## Overview

HRPulse is designed to simplify HR operations by providing different dashboards and functionalities based on the user's role.

The system supports four main roles:

- Admin
- HR
- Manager
- Employee

Each role has different permissions and access levels to ensure that users can only access the features relevant to their responsibilities.

---

## Main Features

### Authentication & Authorization

- User registration and login
- Secure password hashing
- Session-based authentication
- Role-based redirection after login
- Role-based access control
- Protected routes using middleware
- Logout functionality
- Current password verification when changing passwords

Supported roles:

- Admin
- HR
- Manager
- Employee

---

## HR Management

The HR dashboard provides tools for managing the organization's employees and HR-related data.

### Employee Management

HR users can:

- Add new employees
- Edit employee information
- Delete employees
- Search employees by name or email
- Filter employees by department
- Filter employees by position
- Upload employee profile photos
- Assign departments and positions
- Set employee status
- Set hiring date
- Manage employee salaries

Employee information includes:

- Name
- Email
- Password
- Department
- Position
- Phone
- Address
- Profile photo
- Hire date
- Employment status
- Salary information

---

## Department Management

The system allows HR/Admin users to manage organizational departments.

Each department can contain:

- Department name
- Manager
- Employees
- Positions

Departments are connected to employees and positions through database relationships.

---

## Position Management

Positions represent the different job roles available within departments.

The system supports:

- Creating positions
- Assigning positions to departments
- Assigning positions to employees
- Filtering employees by position

---

## Salary Management

Each employee can have salary information containing:

- Basic salary
- Bonus
- Deduction
- Net salary
- Salary start date
- Salary end date

The net salary is calculated automatically:

    Net Salary = Basic Salary + Bonus - Deduction

Salary records are related to employees using Eloquent relationships.

---

## Attendance Management

The attendance module allows the system to keep track of employee attendance records.

Attendance data can be used to track employee presence and manage attendance-related information from the HR/Manager side.

---

## Leave Request Management

Employees can submit leave requests containing:

- Leave type
- Start date
- End date
- Reason

Every leave request starts with:

    pending

Managers can review leave requests and change their status to:

- Approved
- Rejected

The system also displays leave request statistics such as:

- Pending requests
- Approved requests
- Rejected requests

---

## Employee Profile

Employees have access to their own profile page.

They can:

- View their personal information
- View department information
- View position information
- Update their profile photo
- Change their password

Password changes require the current password for additional security.

---

## Role-Based Dashboards

Each role has its own dashboard and permissions.

### Admin

The Admin has access to system-level functionality and management features.

### HR

HR users can manage:

- Employees
- Departments
- Positions
- Salaries
- HR-related information

### Manager

Managers can:

- View employees
- Review leave requests
- Approve leave requests
- Reject leave requests
- Access manager-specific information

### Employee

Employees can:

- View their dashboard
- View their profile
- Update their profile photo
- Change their password
- Submit leave requests
- View their leave request history

---

## Technology Stack

### Backend

- PHP 8.5
- Laravel 13
- Laravel Eloquent ORM

### Database

- MySQL
- phpMyAdmin

### Frontend

- HTML5
- CSS3
- Bootstrap
- Blade Templates

### Development Environment

- XAMPP
- Composer
- Git
- GitHub
- Visual Studio Code

---

## Project Architecture

The project follows the Laravel MVC architecture.

### Models

The application uses Eloquent Models to represent database entities.

Main models include:

- User
- Role
- Permission
- Employee
- Department
- Position
- Salary
- Attendance
- LeaveRequest

Models define relationships between the different entities.

For example:

    User
      |
      └── Employee
            ├── Department
            ├── Position
            └── Salaries

---

## Eloquent Relationships

The project uses Laravel Eloquent relationships to connect related data.

Examples include:

### Employee → User

    Employee belongsTo User

### Employee → Department

    Employee belongsTo Department

### Employee → Position

    Employee belongsTo Position

### Employee → Salaries

    Employee hasMany Salary

### Department → Employees

    Department hasMany Employee

These relationships allow related information to be loaded efficiently using methods such as:

    with()

and:

    load()

---

## Database Structure

The main database entities include:

    users
    roles
    permissions
    role_permission
    departments
    positions
    employees
    salaries
    attendances
    leave_requests

### Users

Stores authentication and basic user information.

### Roles

Stores available system roles.

### Permissions

Stores system permissions.

### Departments

Stores organizational departments.

### Positions

Stores job positions and their department relationships.

### Employees

Stores employee-specific information and connects employees with users, departments, and positions.

### Salaries

Stores employee salary information.

### Attendances

Stores employee attendance records.

### Leave Requests

Stores employee leave requests and their current status.

---

## Database Relationships

The database uses foreign keys to maintain referential integrity.

Examples:

    employees.user_id
        ↓
    users.id

    employees.department_id
        ↓
    departments.id

    employees.position_id
        ↓
    positions.id

    salaries.employee_id
        ↓
    employees.id

    leave_requests.employee_id
        ↓
    employees.id

Foreign key constraints help prevent invalid relationships between database records.

---

## Migrations

Laravel migrations are used to create and modify the database structure.

The project includes migrations for:

- Users
- Cache
- Jobs
- Roles
- Permissions
- Role permissions
- User roles
- Departments
- Positions
- Employees
- Salaries
- Attendance
- Leave requests
- Additional employee/user fields

Migrations make it possible to recreate the database structure consistently across different environments.

---

## Form Requests & Validation

The project uses Laravel Form Request classes to keep validation logic separate from controllers.

Examples include:

- StoreEmployeeRequest
- UpdateEmployeeRequest
- UpdateProfileRequest
- UpdatePasswordRequest

This keeps controllers cleaner and makes validation rules easier to maintain.

Examples of validation include:

- Required fields
- Email format
- Unique emails
- Existing department IDs
- Existing position IDs
- Password confirmation
- Minimum password length
- Image validation
- File size limits
- Date validation
- Salary numeric validation
- Allowed employee status values

---

## Employee Creation Workflow

When HR creates a new employee, the system performs several operations.

### Step 1 — Create User

A new record is created in the `users` table.

### Step 2 — Create Employee

The employee record is created and connected to the newly created user.

### Step 3 — Upload Photo

If a photo was provided, it is stored using Laravel's public storage disk.

### Step 4 — Create Salary

If salary information was provided, a salary record is created for the employee.

### Step 5 — Calculate Net Salary

The system calculates:

    Net Salary = Basic + Bonus - Deduction

All related operations are wrapped inside a database transaction.

---

## Database Transactions

Employee creation and updating use Laravel database transactions.

Example:

    DB::transaction(function () {
        // database operations
    });

This ensures that related operations are treated as one unit.

For example, when creating an employee:

- User creation
- Employee creation
- Salary creation
- Related updates

are performed within the same transaction.

If an operation fails, the transaction can be rolled back to prevent partially created data.

---

## Search & Filtering

The employee management page supports dynamic filtering.

Users can search employees by:

- Name
- Email

Employees can also be filtered by:

- Department
- Position

The project uses Eloquent query methods such as:

    when()

    whereHas()

    latest()

    paginate()

---

## Pagination

Employee records are paginated to avoid loading all employees at once.

The application uses:

    paginate(10)

This displays 10 employees per page.

The current query parameters are preserved using:

    withQueryString()

This means filters and search values remain active while navigating between pages.

---

## File Uploads

Employee profile photos are stored using Laravel's filesystem.

Uploaded files are stored in:

    storage/app/public/employees

The public storage link is created using:

    php artisan storage:link

Supported image formats:

- JPG
- JPEG
- PNG
- WEBP

Maximum file size:

    2 MB

---

## Soft Deletes

Employees use Laravel Soft Deletes.

The Employee model uses:

    use SoftDeletes;

This means deleting an employee does not immediately remove the record from the database.

Instead, Laravel stores a deletion timestamp in:

    deleted_at

This provides a safer way to handle employee deletion and allows deleted records to be restored if needed.

---

## Factories

Laravel model factories are used to generate fake data during development and testing.

For example, the EmployeeFactory generates:

- Random addresses
- Random phone numbers
- Random profile photos
- Random hire dates
- Default employee status

Factories make it easy to generate multiple test employees without manually entering every record.

Example:

    Employee::factory()->count(10)->create();

---

## Seeders

Seeders are used to populate the database with initial or predefined data.

The project uses seeders for data such as:

- Roles
- Permissions
- Departments
- Positions
- Employees
- Other required system data

Some data is manually defined inside seeders because it represents specific business data that should remain predictable.

For example, predefined users or employees can be created with known emails so they can be used for testing specific roles and workflows.

Factories are used when the goal is to generate random or large amounts of test data.

### Factory vs Seeder

Factories and seeders serve different purposes.

Factory:

    Generates realistic fake/random data.

Seeder:

    Inserts predefined or required application data.

They can also be used together.

For example:

    Employee::factory()->count(10)->create();

can generate additional random employees after predefined employees have been created.

---

## Authorization

The application uses role-based authorization through middleware.

Routes are protected using role middleware such as:

    role:employee

    role:manager

    role:hr

    role:admin

This prevents users from accessing pages that belong to other roles.

For example, an employee cannot directly access manager functionality simply by entering the URL.

---

## Authentication Flow

The login process follows these steps:

1. User enters email and password.
2. Laravel attempts authentication using the provided credentials.
3. The session is regenerated after successful authentication.
4. The authenticated user's role is retrieved.
5. The user is redirected to the appropriate dashboard.

Example role-based routing:

    employee → employee.dashboard
    hr       → hr.dashboard
    manager  → manager.dashboard
    admin    → admin.dashboard

---

## Security

The project applies several security practices including:

- Password hashing
- Authentication middleware
- Role-based authorization
- Form Request validation
- CSRF protection
- Password confirmation
- Current password verification
- Database foreign keys
- Database transactions
- File upload validation
- Soft deletes

Passwords are never stored as plain text.

Laravel hashing is used when creating or updating passwords.

---

## Installation

### Requirements

Make sure the following are installed:

- PHP 8.2+
- Composer
- MySQL
- XAMPP
- Git

---

### Clone the Repository

    git clone https://github.com/mennamahmoud007/HRPulse.git

Move into the project directory:

    cd HRPulse

---

### Install Dependencies

    composer install

---

### Environment Configuration

Create the `.env` file:

    cp .env.example .env

On Windows, you can also copy `.env.example` manually and rename it to:

    .env

Generate the Laravel application key:

    php artisan key:generate

---

### Database Configuration

Create a MySQL database named:

    hr-management-system

Update the database configuration in `.env`:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=hr-management-system
    DB_USERNAME=root
    DB_PASSWORD=

Adjust the username and password according to your local MySQL configuration.

---

### Run Migrations

    php artisan migrate

---

### Run Seeders

    php artisan db:seed

If the project uses the main DatabaseSeeder to call all required seeders, this command will populate the database with the required initial data.

---

### Storage Link

Create the symbolic link for uploaded files:

    php artisan storage:link

---

### Start the Development Server

    php artisan serve

The application will normally be available at:

    http://127.0.0.1:8000

---

## Development Workflow

The project was developed using Git and GitHub with multiple branches for feature development and integration.

The final integrated version was maintained in:

    integration-final

The final version was then pushed to the main branch of the HRPulse repository.

---

## Project Structure

The main Laravel project structure is:

    HRPulse/
    │
    ├── app/
    │   ├── Http/
    │   │   ├── Controllers/
    │   │   ├── Middleware/
    │   │   └── Requests/
    │   │
    │   └── Models/
    │
    ├── database/
    │   ├── factories/
    │   ├── migrations/
    │   └── seeders/
    │
    ├── resources/
    │   └── views/
    │
    ├── routes/
    │   └── web.php
    │
    ├── public/
    │
    ├── storage/
    │
    ├── .env.example
    ├── composer.json
    └── artisan

---

## Main Controllers

The application contains controllers responsible for different parts of the system.

Examples include:

- AuthController
- EmployeeController
- ProfileController
- DepartmentController
- PositionController
- SalaryController
- AttendanceController
- LeaveRequestController
- ManagerLeaveRequestController

Controllers are responsible for handling HTTP requests and coordinating application logic with models and views.

---

## Main Form Requests

The project separates validation logic into dedicated Form Request classes.

Examples:

    StoreEmployeeRequest
    UpdateEmployeeRequest
    UpdateProfileRequest
    UpdatePasswordRequest

This keeps validation logic outside the controllers and makes the code easier to maintain.

---

## Main Models

### User

Represents an authenticated system user.

### Role

Represents the user's role and access level.

### Permission

Represents available permissions.

### Employee

Stores employee-specific information and relationships.

### Department

Represents an organizational department.

### Position

Represents a job position.

### Salary

Stores employee salary records.

### Attendance

Stores employee attendance information.

### LeaveRequest

Stores employee leave requests and their approval status.

---

## Example Employee Creation Logic

The EmployeeController uses a database transaction when creating an employee.

Conceptually, the workflow is:

    Validate Request
          ↓
    Create User
          ↓
    Create Employee
          ↓
    Upload Photo
          ↓
    Create Salary
          ↓
    Commit Transaction

If one of the operations fails, the transaction prevents the database from being left in an inconsistent state.

---

## Error Handling

Laravel's built-in exception handling is used throughout the application.

Validation errors are handled through Laravel Form Requests.

Unauthorized access is handled through:

    abort(403)

Database integrity is protected through foreign key constraints.

---

## Future Improvements

Possible future improvements include:

- Advanced permission management
- Employee performance management
- Payroll processing
- Automated attendance reports
- Exporting HR reports to Excel/PDF
- Email notifications
- Leave balance tracking
- Dashboard analytics
- Advanced audit logs
- REST API integration
- Automated testing
- More granular role permissions

---

## Learning Objectives

This project provided practical experience with:

- Laravel MVC architecture
- PHP backend development
- MySQL database design
- Eloquent ORM
- Database migrations
- Model relationships
- Factories
- Seeders
- Form Requests
- Validation
- Authentication
- Authorization
- Middleware
- Database transactions
- File storage
- Soft deletes
- CRUD operations
- Pagination
- Search and filtering
- Git and GitHub collaboration

---

## Project Status

The project is currently a functional HR Management System with integrated HR, Manager, Employee, and Admin workflows.

The final version is maintained in the `main` branch of the HRPulse repository.

---

## Author

**Menna Mahmoud**

Computer Science & Artificial Intelligence Student  
Cairo University

---

## License

This project was developed for educational and training purposes as part of the NTI Full Stack Web Development training.
