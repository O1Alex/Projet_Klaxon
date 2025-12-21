CREATE DATABASE IF NOT EXISTS covoiturage;
USE covoiturage;

CREATE TABLE agences(
    id INT AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255),
    role ENUM('user','admin') DEFAULT 'user'
);

CREATE TABLE trajets(
    id INT AUTO_INCREMENT PRIMARY KEY,
    start_agency_id INT NOT NULL,
    end_agency_id INT NOT NULL,
    departure_date DATETIME NOT NULL,
    arrival_date DATETIME NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL,
    person_contact_id INT NOT NULL,
    
    FOREIGN KEY (start_agency_id) REFERENCES agences(id),
    FOREIGN KEY (end_agency_id) REFERENCES agences(id),
    FOREIGN KEY (person_contact_id) REFERENCES users(id)
);