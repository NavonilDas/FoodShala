CREATE DATABASE foodshala CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE user_type(
	id INT PRIMARY KEY AUTO_INCREMENT,
	type VARCHAR(20) NOT NULL
);

INSERT INTO user_type(`type`) VALUES
('Resturant'),
('Customer');

CREATE TABLE preference(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL
);

INSERT INTO preference(`name`) VALUES
('Veg'),
('Non Veg');

CREATE TABLE Resturant(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	address VARCHAR(255)
);

CREATE TABLE user(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	phone INT(10) NOT NULL UNIQUE,
	password VARCHAR(1024) NOT NULL,
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	preference int,
	resturant int,
	type int NOT NULL,
	FOREIGN KEY (type) REFERENCES user_type(id),
	FOREIGN KEY (preference) REFERENCES preference(id),
	FOREIGN KEY (resturant) REFERENCES Resturant(id)
);
