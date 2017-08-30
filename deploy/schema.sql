--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id`          int(32)  NOT NULL        AUTO_INCREMENT,
  `name`        varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `role_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id`          int(32)  NOT NULL        AUTO_INCREMENT,
  `role_id`     int(32)      NULL,
  `name`        varchar(255) NULL,
  `email`       varchar(255) NOT NULL,
  `password`    varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_email` (`email`),
  FOREIGN KEY (`role_id`)
    REFERENCES `roles`(`id`)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

