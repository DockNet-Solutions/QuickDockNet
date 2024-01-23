CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(32) NOT NULL,       
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NULL,
  `joinDate` int(11) NOT NULL,
  `active` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `passRecover` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `token` varchar(32) NOT NULL,
    `email` varchar(255) NOT NULL,
    `createdAt` int(11) NOT NULL,
    `userId` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;