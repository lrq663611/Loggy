#### NOTE: constraints should have different names even in different tables
#### NOTE: we should create tables without constraint(simple tables) before creating tables with constraint(complicated ones). The following sequence is not correct
#### NOTE: both delete and update should cascade for many to many tables(vehicle_model_part, service_change_soon, service_entry, service_part_changed), means if parent changed/deleted, child will change/delete as well. but cascade on update and dont do anything on delete for 1 to many tables, you are not allowed to delete parent if child exists
#### NOTE: fk_added_by8, fk_added_by20 is missing because service_entry_cat doesnt need it


DROP TABLE IF EXISTS `part`;

CREATE TABLE `part` (
	`id` int(8) AUTO_INCREMENT,
	`part_manufacture_id` int(8),
	`name` varchar(400),
	`description` varchar(2000),
	`part_group_id` int(2),
	`part_type_id` int(4),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,		
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_part_manufacture` FOREIGN KEY (`part_manufacture_id`) REFERENCES `part_manufacture` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_part_group` FOREIGN KEY (`part_group_id`) REFERENCES `part_group` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_part_type` FOREIGN KEY (`part_type_id`) REFERENCES `part_type` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by3` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by15` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `part_group`;

CREATE TABLE `part_group` (
	`id` int(2) AUTO_INCREMENT,
	`description` varchar(400),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `part_manufacture`;

CREATE TABLE `part_manufacture` (
	`id` int(8) AUTO_INCREMENT,
	`name` varchar(40),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,			
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_added_by1` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by13` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE	
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `part_type`;

CREATE TABLE `part_type` (
	`id` int(4) AUTO_INCREMENT,
	`name` varchar(40),
	`description` varchar(4000),
	`part_type_cat_id` int(2),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,		
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_part_type_cat` FOREIGN KEY (`part_type_cat_id`) REFERENCES `part_type_cat` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by2` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by14` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `part_type_cat`;

CREATE TABLE `part_type_cat` (
	`id` int(2) AUTO_INCREMENT,
	`name` varchar(40),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle` (
	`id` int(12) AUTO_INCREMENT,
	`rego_num` varchar(10),
	`vin` varchar(40),
	`engine_num` varchar(40),
	`vehicle_model_id` int(8),
	`body_type` varchar(100),
	`drive_type` varchar(100),		
	`transmission` varchar(100),
	`engine` varchar(100),		
	`color` varchar(20),
	`state` varchar(20),
	`owner_id` int(11) unsigned,
	`note` varchar(400),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,			
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_vehicle_model1` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_model` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by6` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by18` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `vehicle_make`;

CREATE TABLE `vehicle_make` (
	`id` int(8) AUTO_INCREMENT,
	`name` varchar(40),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,		
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_added_by4` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by16` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `vehicle_model`;

CREATE TABLE `vehicle_model` (
	`id` int(8) AUTO_INCREMENT,
	`vehicle_make_id` int(8),
	`year` int(4),
	`name` varchar(400),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,	
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_vehicle_make` FOREIGN KEY (`vehicle_make_id`) REFERENCES `vehicle_make` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by5` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by17` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `vehicle_model_part`;

CREATE TABLE `vehicle_model_part` (
	`id` int(16) AUTO_INCREMENT,
	`vehicle_model_id` int(8),	
	`part_id` int(8),
	`is_default` tinyint(1),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,	
	PRIMARY KEY (`id`),
	CONSTRAINT `unique_vehicle_model_part` UNIQUE (`vehicle_model_id`, `part_id`),
	CONSTRAINT `fk_vehicle_model2` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_model` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_part1` FOREIGN KEY (`part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by7` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by19` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `service`;

CREATE TABLE `service` (
	`id` int(12) AUTO_INCREMENT,
	`vehicle_id` int(12),	
	`start_date` int(11),
	`finish_date` int(11),
	`status` tinyint(1) DEFAULT 1,
	`description` varchar(400),
	`added` int(11),
	`added_by_id` int(11) unsigned,
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,	
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by9` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by21` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `service_change_soon`;

CREATE TABLE `service_change_soon` (
	`id` int(12) AUTO_INCREMENT,
	`service_id` int(12),
	`old_part_id` int(8),
	`added` int(11),
	`added_by_id` int(11) unsigned,
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,	
	PRIMARY KEY (`id`),
	CONSTRAINT `unique_service_change_soon` UNIQUE (`service_id`, `old_part_id`),
	CONSTRAINT `fk_service_id1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_part2` FOREIGN KEY (`old_part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by10` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by22` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `service_entry`;

CREATE TABLE `service_entry` (
	`id` int(12) AUTO_INCREMENT,
	`service_id` int(12),
	`service_entry_cat_id` int(2),
	`description` varchar(4000),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,		
	PRIMARY KEY (`id`),
	CONSTRAINT `fk_service_id2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_service_entry_cat` FOREIGN KEY (`service_entry_cat_id`) REFERENCES `service_entry_cat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by11` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by23` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `service_entry_cat`;

CREATE TABLE `service_entry_cat` (
	`id` int(2) AUTO_INCREMENT,
	`name` varchar(40),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `service_part_changed`;

CREATE TABLE `service_part_changed` (
	`id` int(12) AUTO_INCREMENT,
	`service_id` int(12),
	`old_part_id` int(8),
	`new_part_id` int(8),
	`added` int(11),
	`added_by_id` int(11) unsigned,	
	`last_edit` int(11),
	`last_edit_by_id` int(11) unsigned,		
	PRIMARY KEY (`id`),
	CONSTRAINT `unique_service_part_changed` UNIQUE (`service_id`, `old_part_id`),
	CONSTRAINT `fk_service_id3` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_part3` FOREIGN KEY (`old_part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_part4` FOREIGN KEY (`new_part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by12` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT `fk_added_by24` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;