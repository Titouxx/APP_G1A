-- Table structure for 'users'
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Assuming hashed passwords
    email VARCHAR(100),
    -- Additional user fields (e.g., registration date, etc.) can go here
    -- ...
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table structure for 'discussions'
CREATE TABLE IF NOT EXISTS discussions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    topic_name VARCHAR(255) NOT NULL,
    opening_message TEXT NOT NULL,
    username VARCHAR(50) NOT NULL, -- Username of the user who started the discussion
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES users(username)
);

-- Table structure for 'messages'
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    discussion_id INT NOT NULL,
    username VARCHAR(50) NOT NULL, -- Username of the user who posted the message
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (discussion_id) REFERENCES discussions(id),
    FOREIGN KEY (username) REFERENCES users(username)
);
