Pour la base de donnée on a utiliser http://localhost/phpmyadmin  et ci joint sa structure

CREATE DATABASE todolist;
USE todolist;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    status ENUM('à faire', 'terminée') DEFAULT 'à faire',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
