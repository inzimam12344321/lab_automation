CREATE DATABASE lab_automation;

USE lab_automation;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') DEFAULT 'staff',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Testings Table
CREATE TABLE testings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Reports Table
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    testing_id INT,
    result TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (testing_id) REFERENCES testings(id)
);
-- Insert data into users table
INSERT INTO users (name, email, password, role) VALUES
('Admin User', 'admin@example.com', MD5('admin123'), 'admin'),
('Staff User1', 'staff1@example.com', MD5('staff123'), 'staff'),
('Staff User2', 'staff2@example.com', MD5('staff123'), 'staff');

-- Insert data into categories table
INSERT INTO categories (name, description) VALUES
('Blood Test', 'Category for all types of blood tests'),
('Urine Test', 'Category for all types of urine tests'),
('Imaging', 'Category for imaging-related tests (e.g., X-ray, MRI)');

-- Insert data into testings table
INSERT INTO testings (category_id, name, price) VALUES
(1, 'Complete Blood Count (CBC)', 50.00),
(2, 'Urine Analysis', 30.00),
(3, 'Chest X-ray', 100.00);

-- Insert data into reports table
INSERT INTO reports (user_id, testing_id, result) VALUES
(2, 1, 'Normal range for CBC'),
(3, 2, 'Urine analysis indicates slight infection'),
(2, 3, 'Chest X-ray shows no abnormalities');
