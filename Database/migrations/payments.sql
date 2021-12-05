drop table if exists payments;
CREATE TABLE `payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reference` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `method` enum('online','cash') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `org` varchar(100) DEFAULT NULL,
  `external_reference` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `acc_name` varchar(100) DEFAULT NULL,
  `user_id` int(10),
  `order_id` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4