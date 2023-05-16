DROP DATABASE db_donate;
CREATE DATABASE db_donate;
USE db_donate;
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    email_address VARCHAR(20) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    password VARCHAR(50) NOT NULL,
    address VARCHAR(100) NOT NULL,
    tokens INT(10) DEFAULT 0,
    isAdmin BOOLEAN DEFAULT 0
);

CREATE TABLE category (
    id INT PRIMARY KEY,
    category_name VARCHAR(50)
);

INSERT INTO category (id, category_name)
VALUES
    (1, 'computers'),
    (2, 'phones'),
    (3, 'television'),
    (4, 'appliances'),
    (5, 'batteries'),
    (6, 'others');

CREATE TABLE donation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    category_id INT,
    item_name VARCHAR(50) NOT NULL,
    image VARCHAR(50),
    description VARCHAR(50) NOT NULL,
    quantity INT DEFAULT 0,
    is_checked BOOLEAN DEFAULT 0,
    date_time DATE DEFAULT CURRENT_DATE(),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (category_id) REFERENCES category(id)
);

-- CREATE TABLE incentive (
--   user_id INT,
--   donation_id INT,
--   FOREIGN KEY (user_id) REFERENCES user(id),
--   FOREIGN KEY (donation_id) REFERENCES donation(id)
-- );