-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 08:30 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `res_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `room_num` int(11) NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `total_price` float NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_events`
--

CREATE TABLE `reservation_events` (
  `res_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_services`
--

CREATE TABLE `reservation_services` (
  `res_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_statuses`
--

CREATE TABLE `reservation_statuses` (
  `stat_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_num` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `room_type_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `max_person` int(11) NOT NULL,
  `pets_allowed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `first_name`, `last_name`, `role`, `created_at`) VALUES
('admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 'Admin', 'Administrator', '2022-10-29 09:51:40'),
('aleks1@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Aleks', 'Zakzak', 'User', '2022-10-29 16:49:39'),
('aleks@gmail.com', '9cc83c052af47f58031faad027531a40c5411c05', 'Aleksandr', 'Zakharov', 'User', '2022-10-29 09:55:27'),
('gamil@sg.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Kok', 'Cec', 'User', '2022-10-31 09:33:54'),
('garoshinvien@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Daniil', 'Slepen', 'User', '2022-10-31 12:26:02'),
('lalka@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Kok', 'Coc', 'User', '2022-10-31 09:44:21'),
('rebi@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Andrei', 'Ribin', 'User', '2022-10-31 09:32:13'),
('slep@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Daniil', 'Slepen', 'User', '2022-10-31 12:24:20'),
('tewtw@gmail.com', '8033a7f55d17f679ee0cdef9f9841679476f46f9', 'Aksel', 'lalaa', 'User', '2022-10-31 09:48:34');

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
  ADD PRIMARY KEY (`res_id`,`status_id`);

--
-- Indexes for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD PRIMARY KEY (`res_id`,`service_id`),
  ADD KEY `fk_reservation_services_service_id` (`service_id`);

--
-- Indexes for table `reservation_statuses`
--
ALTER TABLE `reservation_statuses`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_num`),
  ADD KEY `fk_rooms_room_type` (`room_type`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_statuses`
--
ALTER TABLE `reservation_statuses`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_reservation_events_res_id` FOREIGN KEY (`res_id`) REFERENCES `reservations` (`res_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reservation_events_status_id` FOREIGN KEY (`status_id`) REFERENCES `reservation_statuses` (`stat_id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD CONSTRAINT `fk_reservation_services_res_id` FOREIGN KEY (`res_id`) REFERENCES `reservations` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_services_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_room_type` FOREIGN KEY (`room_type`) REFERENCES `room_types` (`room_type_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
