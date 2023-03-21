CREATE TABLE IF NOT EXISTS `user_colors` (
  `color_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`color_id`,`user_id`),
  KEY `fk_641a160485db8` (`color_id`),
  KEY `fk_641a160fa8333` (`user_id`),
  CONSTRAINT `fk_641a160485db8` 
    FOREIGN KEY (`color_id`) 
        REFERENCES `colors` (`id`) 
            ON DELETE CASCADE 
            ON UPDATE NO ACTION,
  CONSTRAINT `fk_641a160fa8333` 
    FOREIGN KEY (`user_id`) 
        REFERENCES `user` (`id`) 
            ON DELETE CASCADE 
            ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
