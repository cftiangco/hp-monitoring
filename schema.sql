CREATE DATABASE hpmonitoring;

CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    username VARCHAR(50),
    pword VARCHAR(100),
    role_id SMALLINT,
    tstamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);