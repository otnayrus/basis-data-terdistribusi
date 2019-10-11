CREATE TABLE IF NOT EXISTS `users` (
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `trn_date` datetime NOT NULL,
 PRIMARY KEY (`username`)
 );

CREATE TABLE IF NOT EXISTS `problems`(
	`p_id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(50) NOT NULL,
	`description` varchar(300) NOT NULL,
	`flag` varchar(50) NOT NULL,
	`date_created` datetime NOT NULL,
	`score` int NOT NULL,
	`pname` varchar(50) NOT NULL,
	`pcategory` varchar(50) NOT NULL,
	PRIMARY KEY (`p_id`)
);

ALTER TABLE `problems`
ADD CONSTRAINT FK_PCREATOR FOREIGN KEY (`username`) REFERENCES users(`username`);

CREATE TABLE IF NOT EXISTS `submission`(
    `sid` int NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `answer` varchar(50) NOT NULL,
    `timesubmit` datetime,
    `iscorrect` boolean,
    PRIMARY KEY (`sid`)
    );

ALTER TABLE `submission`
ADD `p_id` int(11) NOT NULL;

ALTER TABLE `submission`
ADD CONSTRAINT FK_SUBMITP FOREIGN KEY (`p_id`) REFERENCES problems(`p_id`);

ALTER TABLE `submission`
ADD CONSTRAINT FK_SUBMITU FOREIGN KEY (`username`) REFERENCES users(`username`);

ALTER TABLE `users`
ADD `u_score` int DEFAULT 0;

CREATE TABLE IF NOT EXISTS `files` (
	`f_id` varchar(20) NOT NULL,
	`f_name` varchar(200) NOT NULL,
	`f_type` varchar(30) NOT NULL,
	`f_size` int(11) NOT NULL,
	`content` mediumblob NOT NULL,
	PRIMARY KEY (`f_id`)
)

ALTER TABLE `problems` ADD `f_id` varchar(20);

-- ADD CONSTRAINT FK_PROBLEMFILE FOREIGN KEY (`f_id`) REFERENCES files(`f_id`) ;