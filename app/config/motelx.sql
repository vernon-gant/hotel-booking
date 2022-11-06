-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 04:46 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motelx`
--

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(90) NOT NULL,
  `city` varchar(90) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `first_name`, `last_name`, `address`, `city`, `dob`, `phone`) VALUES
(1, 'Aleksandr', 'Zakharov', 'Matthias Schönerer Gasse 11/1/404', 'Wien', '2001-06-14', '4367762905384');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `res_id` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `room_num` int(11) NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `total_price` float NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`res_id`, `user_email`, `guest_id`, `room_num`, `arrival`, `departure`, `total_price`, `transaction_date`) VALUES
('1L874TZ', 'aleks@gmail.com', 1, 3, '2022-11-07', '2022-11-10', 230, '2022-11-06 13:32:39'),
('BA3456PI', 'admin@gmail.com', 1, 10, '2022-11-08', '2022-11-09', 100, '2022-11-06 15:34:43'),
('KAF4563', 'garoshinvien@gmail.com', 1, 20, '2022-11-05', '2022-11-07', 500, '2022-11-06 15:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_events`
--

CREATE TABLE `reservation_events` (
  `res_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('new','confirmed','canceled') NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_services`
--

CREATE TABLE `reservation_services` (
  `res_id` varchar(50) NOT NULL,
  `service_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation_services`
--

INSERT INTO `reservation_services` (`res_id`, `service_name`) VALUES
('1L874TZ', 'breakfast'),
('1L874TZ', 'parking');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_num` int(11) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `floor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_num`, `room_type`, `floor`) VALUES
(1, 'Single Room', 1),
(2, 'Single Room', 1),
(3, 'Hollywood Twin Room', 1),
(4, 'Family Suite', 1),
(5, 'Family Suite', 1),
(6, 'Double Suite', 2),
(7, 'Single Room', 2),
(8, 'Double Suite', 2),
(9, 'Single Room', 2),
(10, 'Double Suite', 2),
(11, 'Family Suite', 3),
(12, 'Single Room', 3),
(13, 'Family Suite', 3),
(14, 'Double Suite', 3),
(15, 'Hollywood Twin Room', 3),
(16, 'King Standard', 4),
(17, 'Hollywood Twin Room', 4),
(18, 'King Standard', 4),
(19, 'Hollywood Twin Room', 4),
(20, 'King Standard', 4);

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `max_person` int(11) NOT NULL,
  `pets_allowed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`name`, `price`, `description`, `max_person`, `pets_allowed`) VALUES
('Double Suite', 100, 'Cosy room with a double bed with mini bar and else...', 3, 1),
('Family Suite', 400, 'A big apartament with 3 rooms,one bed for parents and one/two beds for children', 6, 1),
('Hollywood Twin Room', 200, 'A room that can accommodate two persons with two twin beds joined together by a common headboard.', 2, 0),
('King Standard', 500, 'Large room with big windows and a personal service man for you!', 5, 0),
('Single Room', 50, 'A single room for 1 person', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`name`, `description`, `price`) VALUES
('breakfast', 'Amazing breakfast just for 20 eu', 20),
('parking', 'Secured car territory with video surveillance', 10),
('pets', 'Fee for having pets just by the hand at your room', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `first_name`, `last_name`, `role`, `created_at`, `status`) VALUES
('admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 'Admin', 'Administrator', '2022-10-29 09:51:40', 'active'),
('aleks123@gmail.com', 'e6730c649a6e001841db082f7cd139604a8fe3ad', 'Aleks', 'Zakaka', 'User', '2022-11-06 09:49:42', 'active'),
('aleks1@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Aleks', 'Zakzak', 'User', '2022-10-29 16:49:39', 'active'),
('aleks@gmail.com', '9cc83c052af47f58031faad027531a40c5411c05', 'Aleksandr', 'Zakharov', 'User', '2022-10-29 09:55:27', 'active'),
('andrew_fisher@gmail.com', '3c5ecae19eb9b8d6b80e02dd6a3b197759e30679', 'Andrew', 'Fisher', 'User', '2022-11-06 11:12:28', 'active'),
('gamil@sg.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Kok', 'Cec', 'User', '2022-10-31 09:33:54', 'active'),
('garoshinvien@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Daniil', 'Slepen', 'User', '2022-10-31 12:26:02', 'active'),
('lalka@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Kok', 'Coc', 'User', '2022-10-31 09:44:21', 'active'),
('rebi@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Andrei', 'Ribin', 'User', '2022-10-31 09:32:13', 'active'),
('slep@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Daniil', 'Slepen', 'User', '2022-10-31 12:24:20', 'active'),
('tewtw@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Aksel', 'lalaa', 'User', '2022-10-31 09:48:34', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `fk_reservations_user_id` (`user_email`),
  ADD KEY `fk_reservations_guest_id` (`guest_id`),
  ADD KEY `fk_reservations_room_num` (`room_num`);

--
-- Indexes for table `reservation_events`
--
ALTER TABLE `reservation_events`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD PRIMARY KEY (`res_id`,`service_name`),
  ADD KEY `fk_service_name` (`service_name`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_num`),
  ADD KEY `fk_room_type` (`room_type`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_guest_id` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reservations_room_num` FOREIGN KEY (`room_num`) REFERENCES `rooms` (`room_num`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reservations_user_id` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_events`
--
ALTER TABLE `reservation_events`
  ADD CONSTRAINT `fk_reservation_events_res_id` FOREIGN KEY (`res_id`) REFERENCES `reservations` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD CONSTRAINT `fk_res_id` FOREIGN KEY (`res_id`) REFERENCES `reservations` (`res_id`),
  ADD CONSTRAINT `fk_service_name` FOREIGN KEY (`service_name`) REFERENCES `services` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_room_type` FOREIGN KEY (`room_type`) REFERENCES `room_types` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
