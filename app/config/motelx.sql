-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 03:23 PM
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
(17, 'Daniil', 'Zakaka', 'Maafe SChn G 11', 'workss', '2001-06-14', '+79107796812'),
(18, 'Daniil', 'Fisher', 'Maafe SChn G 11', 'Wien', '2001-06-14', '+79107796812'),
(19, 'Daniil', 'adfAef', 'Maafe SChn G 11', 'dbb', '2001-06-14', '+79107796812'),
(20, 'Daniil', '/adfAef', 'Maafe SChn G 11', 'sdgerg', '2001-06-14', '+79107796812'),
(21, 'Daniil', 'adfAef', 'Maafe SChn G 11', 'Wien', '2001-08-14', '+79107796812'),
(22, 'Daniil', 'Slepen', 'Maafe SChn G 11', 'Wien', '2001-06-14', '+79107796812'),
(23, 'Daniil', 'Sleptsov', 'Maafe SChn G 11', 'sverbvg', '2001-06-14', '+79107796812');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `res_id` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `room_num` int(11) NOT NULL,
  `guests` int(11) NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `total_price` float NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`res_id`, `user_email`, `guest_id`, `room_num`, `guests`, `arrival`, `departure`, `total_price`, `transaction_date`) VALUES
('AZ6SJ77CF5', 'admin@gmail.com', 19, 1, 1, '2022-11-15', '2022-11-17', 145, '2022-11-15 13:42:53'),
('D1EEYGD051', 'admin@gmail.com', 21, 7, 1, '2022-11-15', '2022-11-17', 145, '2022-11-15 13:50:20'),
('EMWE6A0GPM', 'admin@gmail.com', 23, 12, 1, '2022-11-15', '2022-11-17', 145, '2022-11-15 13:53:09'),
('OB7XO27RKA', 'admin@gmail.com', 22, 9, 1, '2022-11-15', '2022-11-17', 145, '2022-11-15 13:51:56'),
('VWXAV0DH9J', 'admin@gmail.com', 20, 2, 1, '2022-11-15', '2022-11-17', 145, '2022-11-15 13:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_events`
--

CREATE TABLE `reservation_events` (
  `res_id` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `status` enum('new','confirmed','canceled') NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation_events`
--

INSERT INTO `reservation_events` (`res_id`, `user_email`, `status`, `details`, `created_at`) VALUES
('AZ6SJ77CF5', 'admin@gmail.com', 'new', ' ', '2022-11-15 13:42:53'),
('D1EEYGD051', 'admin@gmail.com', 'new', ' ', '2022-11-15 13:50:20'),
('EMWE6A0GPM', 'admin@gmail.com', 'new', ' ', '2022-11-15 13:53:09'),
('OB7XO27RKA', 'admin@gmail.com', 'new', ' ', '2022-11-15 13:51:56'),
('VWXAV0DH9J', 'admin@gmail.com', 'new', ' ', '2022-11-15 13:43:56');

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
('AZ6SJ77CF5', 'breakfast'),
('AZ6SJ77CF5', 'parking'),
('AZ6SJ77CF5', 'pets'),
('D1EEYGD051', 'breakfast'),
('D1EEYGD051', 'parking'),
('D1EEYGD051', 'pets'),
('EMWE6A0GPM', 'breakfast'),
('EMWE6A0GPM', 'parking'),
('EMWE6A0GPM', 'pets'),
('OB7XO27RKA', 'breakfast'),
('OB7XO27RKA', 'parking'),
('OB7XO27RKA', 'pets'),
('VWXAV0DH9J', 'breakfast'),
('VWXAV0DH9J', 'parking'),
('VWXAV0DH9J', 'pets');

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
('aleks1234567@gmail.com', '235aa633f6490359c9267ee2f8d2f4720d933924', 'Kok', 'Cecov', 'User', '2022-11-11 08:52:07', 'active'),
('aleks123@gmail.com', 'e6730c649a6e001841db082f7cd139604a8fe3ad', 'Aleks', 'Zakaka', 'User', '2022-11-06 09:49:42', 'active'),
('aleks1@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Aleks', 'Zakzak', 'User', '2022-10-29 16:49:39', 'active'),
('aleks@gmail.com', '9cc83c052af47f58031faad027531a40c5411c05', 'Aleksandr', 'Zakharov', 'User', '2022-10-29 09:55:27', 'active'),
('andrew_fisher@gmail.com', '3c5ecae19eb9b8d6b80e02dd6a3b197759e30679', 'Andrew', 'Fisher', 'User', '2022-11-06 11:12:28', 'active'),
('gamil@sg.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Kok', 'Cec', 'User', '2022-10-31 09:33:54', 'active'),
('garoshinvien@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Daniil', 'Slepen', 'User', '2022-10-31 12:26:02', 'active'),
('info@levus.co', '166602b8fd26ca36c7ce2fc701eb998365c50654', 'Daniil', 'Sleptsov', 'User', '2022-11-11 08:36:32', 'active'),
('infolfhfjzjftj@levus.co', '235aa633f6490359c9267ee2f8d2f4720d933924', 'Daniil', 'Slepen', 'User', '2022-11-11 08:45:06', 'active'),
('infolfhftj@levus.co', '235aa633f6490359c9267ee2f8d2f4720d933924', 'Daniil', 'Slepen', 'User', '2022-11-11 08:41:17', 'active'),
('infolol@levus.co', '166602b8fd26ca36c7ce2fc701eb998365c50654', 'Daniil', 'Slepen', 'User', '2022-11-11 08:39:49', 'active'),
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
  ADD KEY `fk_reservations_guest_id` (`guest_id`),
  ADD KEY `fk_reservations_room_num` (`room_num`),
  ADD KEY `fk_reservations_user_id` (`user_email`);

--
-- Indexes for table `reservation_events`
--
ALTER TABLE `reservation_events`
  ADD PRIMARY KEY (`res_id`,`status`),
  ADD KEY `fk_reservation_events_user_email` (`user_email`);

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
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_guest_id` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservations_room_num` FOREIGN KEY (`room_num`) REFERENCES `rooms` (`room_num`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservations_user_id` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation_events`
--
ALTER TABLE `reservation_events`
  ADD CONSTRAINT `fk_reservation_events_res_id` FOREIGN KEY (`res_id`) REFERENCES `reservations` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_events_user_email` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD CONSTRAINT `fk_res_id` FOREIGN KEY (`res_id`) REFERENCES `reservations` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
