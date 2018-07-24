CREATE TABLE `user_info` (
	`user_id` int(255) NOT NULL AUTO_INCREMENT,
	`name` varchar(191) NOT NULL,
	`email` varchar(191) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`address` TEXT NOT NULL,
	`mobile_number` bigint(12) NOT NULL,
	`type` varchar(5) NOT NULL,
	`status` int(1) NOT NULL,
	`created_date` TIMESTAMP NOT NULL,
	`updated_date` DATETIME NOT NULL,
	PRIMARY KEY (`user_id`)
);

CREATE TABLE `product_info` (
	`product_id` int(255) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`description` TEXT NOT NULL,
	`price` DECIMAL(10,3) NOT NULL,
	`discount` DECIMAL(3,2) NOT NULL,
	`selling_price` DECIMAL(10,3) NOT NULL,
	`status` int(1) NOT NULL,
	`created_date` TIMESTAMP NOT NULL,
	`updated_date` DATETIME NOT NULL,
	PRIMARY KEY (`product_id`)
);

CREATE TABLE `cart_info` (
	`cart_id` int(255) NOT NULL AUTO_INCREMENT,
	`user_id` int(255) NOT NULL,
	`product_id` int(255) NOT NULL,
	`quantity` int(10) NOT NULL,
	`subtotal` DECIMAL(10,3) NOT NULL,
	`status` int(1) NOT NULL,
	`created_date` TIMESTAMP NOT NULL,
	`updated_date` DATETIME NOT NULL,
	PRIMARY KEY (`cart_id`)
);

CREATE TABLE `order_info` (
	`order_id` int(255) NOT NULL AUTO_INCREMENT,
	`user_id` int(255) NOT NULL,
	`product_id` int(255) NOT NULL,
	`cart_id` int(255) NOT NULL,
	`status` int(1) NOT NULL,
	`created_date` TIMESTAMP NOT NULL,
	`updated_date` DATETIME NOT NULL,
	PRIMARY KEY (`order_id`)
);

CREATE TABLE `payment_info` (
	`payment_id` int(255) NOT NULL AUTO_INCREMENT,
	`user_id` int(255) NOT NULL,
	`order_id` int(255) NOT NULL,
	`txn_id` int(255) NOT NULL,
	`status` int(1) NOT NULL,
	`created_date` TIMESTAMP NOT NULL,
	`updated_date` DATETIME NOT NULL,
	PRIMARY KEY (`payment_id`)
);

CREATE TABLE `txn_info` (
	`txn_id` int(255) NOT NULL AUTO_INCREMENT,
	`mode` varchar(21) NOT NULL,
	`amount` DECIMAL(10,2) NOT NULL,
	`status` int(1) NOT NULL,
	`created_date` TIMESTAMP NOT NULL,
	`updated_date` DATETIME NOT NULL,
	PRIMARY KEY (`txn_id`)
);

ALTER TABLE `cart_info` ADD CONSTRAINT `cart_info_fk0` FOREIGN KEY (`user_id`) REFERENCES `user_info`(`user_id`);

ALTER TABLE `cart_info` ADD CONSTRAINT `cart_info_fk1` FOREIGN KEY (`product_id`) REFERENCES `product_info`(`product_id`);

ALTER TABLE `order_info` ADD CONSTRAINT `order_info_fk0` FOREIGN KEY (`user_id`) REFERENCES `user_info`(`user_id`);

ALTER TABLE `order_info` ADD CONSTRAINT `order_info_fk1` FOREIGN KEY (`product_id`) REFERENCES `product_info`(`product_id`);

ALTER TABLE `order_info` ADD CONSTRAINT `order_info_fk2` FOREIGN KEY (`cart_id`) REFERENCES `cart_info`(`cart_id`);

ALTER TABLE `payment_info` ADD CONSTRAINT `payment_info_fk0` FOREIGN KEY (`user_id`) REFERENCES `user_info`(`user_id`);

ALTER TABLE `payment_info` ADD CONSTRAINT `payment_info_fk1` FOREIGN KEY (`order_id`) REFERENCES `order_info`(`order_id`);

ALTER TABLE `payment_info` ADD CONSTRAINT `payment_info_fk2` FOREIGN KEY (`txn_id`) REFERENCES `txn_info`(`txn_id`);

