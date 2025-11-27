-- Database: booking_system
CREATE DATABASE IF NOT EXISTS booking_system;
USE booking_system;

-- ===========================
-- 1. USERS TABLE
-- ===========================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','customer') DEFAULT 'customer'
);

-- Insert default admin
INSERT INTO users (username, password, role)
VALUES ('admin', '$2y$10$abcdefghijklmnopqrstuv1234567890ABCDEabcdeABCDE12345', 'admin');
-- NOTE: Replace the hashed password later with a real hash.

-- ===========================
-- 2. SERVICES TABLE
-- ===========================
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) DEFAULT 0,
    description TEXT
);

-- Sample services
INSERT INTO services (name, price, description) VALUES
('Massage', 999.00, 'Relaxing body massage'),
('Home Service', 1299.00, 'Home visit massage'),
('Therapy', 1499.00, 'Therapeutic treatment session');

-- ===========================
-- 3. BOOKINGS TABLE
-- ===========================
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    customer_name VARCHAR(150) NOT NULL,
    status VARCHAR(150) NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- ===========================
-- 4. PAYMENTS TABLE
-- ===========================
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('cash', 'credit_card', 'gcash', 'paymaya') DEFAULT 'cash',
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    payment_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

-- ===========================
-- 5. REVIEWS TABLE
-- ===========================
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);
