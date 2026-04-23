-- Run this in your MySQL / MariaDB terminal or phpMyAdmin
-- to set up the database and users table

CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS users (
  id        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  fullname  VARCHAR(150) NOT NULL,
  email     VARCHAR(255) NOT NULL UNIQUE,
  password  VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
