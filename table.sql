CREATE TABLE `tasks` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`content` TEXT NOT NULL,
	`images` TEXT NULL,
	`is_completed` TINYINT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=10
;