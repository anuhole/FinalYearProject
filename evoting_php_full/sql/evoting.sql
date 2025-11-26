-- evoting.sql
CREATE DATABASE IF NOT EXISTS evoting;
USE evoting;

CREATE TABLE IF NOT EXISTS voters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    fullname VARCHAR(150),
    is_admin TINYINT(1) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS elections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200),
    start_at DATETIME,
    end_at DATETIME,
    status ENUM('Pending','Ongoing','Completed') DEFAULT 'Pending'
);

CREATE TABLE IF NOT EXISTS candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    election_id INT,
    FOREIGN KEY (election_id) REFERENCES elections(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS blocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    block_index INT,
    timestamp DATETIME,
    data TEXT,
    previous_hash VARCHAR(255),
    hash VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    election_id INT,
    candidate_id INT,
    voter_id INT,
    timestamp DATETIME,
    block_id INT,
    FOREIGN KEY (election_id) REFERENCES elections(id) ON DELETE SET NULL,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE SET NULL,
    FOREIGN KEY (voter_id) REFERENCES voters(id) ON DELETE SET NULL
);

-- Note: create an admin using create_admin.php or insert manually with password_hash value.
