# PHP MySQL Authentication System

A simple full-stack authentication system built with PHP and MySQL. It covers user registration, login, session management, and logout — the foundation of any web application.

---

## Features

- User signup with full name, email, and password
- Password confirmation validation on the frontend
- Passwords stored securely using `password_hash()`
- Duplicate email detection on registration
- Login with email and password verification using `password_verify()`
- Session-based authentication
- Protected homepage (redirects to login if not authenticated)
- Logout that destroys the session

---

## Project Structure

```
CRUD/
├── connection.php   # Database connection
├── signup.php       # Registration form
├── create.php       # Handles registration logic
├── login.php        # Login form + authentication logic
├── homepage.php     # Protected page after login
├── logout.php       # Destroys session and redirects
└── setup.sql        # SQL to create the database and users table
```

---

## Setup Instructions

### 1. Requirements
- XAMPP (or any local server with Apache + PHP + MySQL)
- A browser

### 2. Database Setup
Open your MySQL terminal or phpMyAdmin and run:

```sql
CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS users (
  id         INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  fullname   VARCHAR(150) NOT NULL,
  email      VARCHAR(255) NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Or simply import the `setup.sql` file provided.

### 3. Configure the Connection
Open `connection.php` and update with your credentials:

```php
$servername = 'localhost';
$username   = 'root';
$password   = '';        // your MySQL password
$dbname     = 'student_db';
```

### 4. Run the Project
Place the project folder inside `htdocs` (XAMPP) and visit:

```
http://localhost/CRUD/signup.php
```

---

## How It Works

```
signup.php → create.php → login.php → homepage.php → logout.php → login.php
```

1. New user fills the signup form
2. `create.php` validates input, hashes the password, and inserts into the DB
3. User logs in via `login.php`
4. On success, a session is started and they land on `homepage.php`
5. Clicking logout destroys the session and returns to `login.php`

---

## Built With

- PHP (MySQLi)
- MySQL / MariaDB
- HTML & CSS
- XAMPP

---

## Author

**SimbiLys** — [GitHub](https://github.com/SimbiLys)

---

> Built as part of learning PHP & MySQL CRUD operations at Rwanda Coding Academy.
