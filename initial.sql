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

CREATE TABLE user(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	phone VARCHAR(10) NOT NULL UNIQUE,
	password VARCHAR(1024) NOT NULL,
	address VARCHAR(255),
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	preference int,
	type int NOT NULL,
	FOREIGN KEY (type) REFERENCES user_type(id),
	FOREIGN KEY (preference) REFERENCES preference(id),
	INDEX user_type(type)
);


CREATE TABLE food(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	price FLOAT NOT NULL,
	thumbnail VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	type int NOT NULL,
	created_by int NOT NULL,
	FOREIGN KEY (type) REFERENCES preference(id),
	FOREIGN KEY (created_by) REFERENCES user(id)
);

CREATE TABLE cart(
	food_id int NOT NULL,
	user_id int NOT NULL,
	quantity int NOT NULL DEFAULT 1,
	FOREIGN KEY (food_id) REFERENCES food(id),
	FOREIGN KEY (user_id) REFERENCES user(id),
	PRIMARY KEY(food_id,user_id)
);

CREATE TABLE food_order(
	id INT PRIMARY KEY AUTO_INCREMENT,
	`food_id` INT NOT NULL,
	`user_id` INT NOT NULL,
	`status` ENUM('Pending','Completed','Rejected') NOT NULL DEFAULT 'Pending',
	`quantity` int NOT NULL DEFAULT 1,
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (food_id) REFERENCES food(id),
	FOREIGN KEY (user_id) REFERENCES user(id),
	INDEX(status)
);
