-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2025 at 11:52 AM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kghotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'kongpob', 'kg1234');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `book_detail_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `price_per_night` decimal(10,0) NOT NULL,
  `num_nights` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pnumber` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`book_detail_id`, `booking_id`, `room_id`, `price_per_night`, `num_nights`, `name`, `pnumber`, `address`, `subtotal`) VALUES
(1, 1, 2, 2400, 1, 'kongpob', '0982592063', 'BKK', 2400),
(2, 2, 5, 4000, 2, 'kongpob', '0982592063', 'BKK', 8000),
(3, 3, 3, 4200, 1, 'kongpob', '0982592063', 'BKK', 4200);

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `check_in_date` datetime NOT NULL,
  `check_out_date` datetime NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `status` enum('pending','completed','cancelled','refunding') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `booking_date`, `check_in_date`, `check_out_date`, `total_amount`, `status`) VALUES
(1, 1, '2025-07-07 14:23:12', '2025-07-07 00:00:00', '2025-07-08 00:00:00', 2400, 'cancelled'),
(2, 1, '2025-07-08 08:20:45', '2025-07-08 00:00:00', '2025-07-10 00:00:00', 8000, 'completed'),
(3, 1, '2025-07-08 08:21:26', '2025-07-11 00:00:00', '2025-07-12 00:00:00', 4200, 'refunding');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gmap` longtext NOT NULL,
  `pn1` varchar(10) NOT NULL,
  `pn2` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`) VALUES
(1, '979 Rama I Rd., Pathumwan, Pathumwan, Bangkok 10330', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.5399607549325!2d100.52780697803612!3d13.746279252209991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ecd81421b2b%3A0xa1affc34a5f5632c!2z4Liq4Lii4Liy4Lih4LmA4LiL4LmH4LiZ4LmA4LiV4Lit4Lij4LmM!5e0!3m2!1sth!2sth!4v1745571362152!5m2!1sth!2sth', '0982592063', '0899263544', 'kghotel@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `icon`, `description`) VALUES
(1, 'Air Conditioner', '1745918020_ac.svg', 'Provides a cool and comfortable environment with air conditioning'),
(2, 'Television', '1745918061_tv.svg', 'Equipped with a range of channels for entertainment'),
(3, 'Water Heater', '1745918079_water-heater.svg', 'Hot water available for bathing and other needs'),
(4, 'WiFi', '1745918094_wifi.svg', 'High-speed internet access available for guests'),
(5, 'Breakfast', '1746434620_534188.png', 'Enjoy a tasty selection of hot items, fresh fruit, pastries, and drinks every morning');

--
-- Triggers `facilities`
--
DELIMITER $$
CREATE TRIGGER `delete_related_room_facilities` BEFORE DELETE ON `facilities` FOR EACH ROW BEGIN
  DELETE FROM room_facilities WHERE id_facilities = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(1, 'Bedroom'),
(2, 'Bathroom'),
(3, 'Kitchen');

--
-- Triggers `features`
--
DELIMITER $$
CREATE TRIGGER `delete_related_room_features` BEFORE DELETE ON `features` FOR EACH ROW BEGIN
  DELETE FROM room_features WHERE id_features = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_proof`
--

CREATE TABLE `payment_proof` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount_paid` decimal(10,0) NOT NULL,
  `proof_file_arrival` text NOT NULL,
  `proof_file_refund` text DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `payment_proof`
--

INSERT INTO `payment_proof` (`payment_id`, `booking_id`, `payment_date`, `amount_paid`, `proof_file_arrival`, `proof_file_refund`, `verified`, `verified_at`) VALUES
(1, 1, '2025-07-07 14:23:12', 2400, 'slip_kongpob_2_20250707_686b75e04992b.jpg', 'slip_refund_1751877758_Tpcorp 1x1.jpg', 1, '2025-07-07 15:41:56'),
(2, 2, '2025-07-08 08:20:45', 8000, 'slip_kongpob_5_20250708_686c726d65fc4.jpg', NULL, 0, NULL),
(3, 3, '2025-07-08 08:21:26', 4200, 'slip_kongpob_3_20250708_686c72968c621.jpg', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quant` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `area`, `price`, `quant`, `adult`, `children`, `description`, `status`) VALUES
(1, 'Deluxe King Room', 350, 2800, 4, 2, 1, 'Spacious room with a king-size bed, private balcony, modern bathroom, free Wi-Fi, and complimentary breakfast. Ideal for couples or small families.', 1),
(2, 'Superior Twin Room', 300, 2400, 6, 2, 0, 'Comfortable twin beds, work desk, flat-screen TV, and high-speed internet. Perfect for business travelers or friends.', 1),
(3, 'Family Suite', 500, 4200, 3, 3, 2, 'Large suite with a living area, two queen beds, a sofa bed, kitchenette, and kids-friendly amenities. Ideal for families.', 1),
(4, 'Executive Suite', 600, 5200, 3, 2, 1, 'Luxury suite featuring a separate lounge area, king-size bed, city view, bathtub, and executive work space. Perfect for long stays or business executives.', 1),
(5, 'KG King Room', 380, 4000, 1, 2, 0, 'Spacious room with a king-size bed, private balcony, modern bathroom, free Wi-Fi, and complimentary breakfast. Ideal for couples or small families.', 1);

--
-- Triggers `room`
--
DELIMITER $$
CREATE TRIGGER `delete_related_room_data` BEFORE DELETE ON `room` FOR EACH ROW BEGIN
  -- Delete related data in room_covers
  DELETE FROM room_covers WHERE id_room = OLD.id;

  -- Delete related data in room_facilities
  DELETE FROM room_facilities WHERE id_room = OLD.id;

  -- Delete related data in room_features
  DELETE FROM room_features WHERE id_room = OLD.id;

  -- Delete related data in room_images
  DELETE FROM room_images WHERE id_room = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room_covers`
--

CREATE TABLE `room_covers` (
  `id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `room_covers`
--

INSERT INTO `room_covers` (`id`, `cover`, `id_room`) VALUES
(1, 'cover_1746418602_1280x720-placeholder.webp', 1),
(2, 'cover_1746418617_1280x720-placeholder.webp', 2),
(3, 'cover_1746418634_1280x720-placeholder.webp', 3),
(4, 'cover_1746418650_1280x720-placeholder.webp', 4),
(5, 'cover_1746693833_1280x720-placeholder.webp', 5);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_facilities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_features` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(255) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'KG HOTEL', 'KG Hotel is Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus aliquid beatae iure molestias ipsum itaque, adipisci quas ad eum inventore assumenda dignissimos incidunt quos, ratione expedita facere? Totam, accusantium pariatur.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` varchar(10) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(1, 'Alice Johnson', 'alice.johnson@example.com', 'Booking inquiry', 'I would like to know if there are rooms available from May 5 to May 10.', '2025-04-20', 1),
(2, 'Bob Smith', 'bobsmith@gmail.com', 'Pet policy', 'Do you allow small dogs in your hotel rooms?', '2025-04-21', 1),
(3, 'Clara Lee', 'claralee@yahoo.com', 'Event hosting', 'Can your hotel accommodate a wedding reception for 100 guests?', '2025-04-22', 0),
(4, 'David Kim', 'dkim@outlook.com', 'Room issue', 'There was no hot water in my bathroom during my stay.', '2025-04-23', 0),
(5, 'Eva Martinez', 'eva.martinez@mail.com', 'Airport shuttle', 'Does the hotel provide shuttle service to and from the airport?', '2025-04-24', 0),
(6, 'Frank Turner', 'fturner@hotmail.com', 'Cancellation policy', 'What is your cancellation policy for a prepaid booking?', '2025-04-25', 0),
(7, 'Grace Liu', 'grace.liu@gmail.com', 'Lost item', 'I think I left my headphones in Room 305. Can you check?', '2025-04-26', 0),
(8, 'Henry Davis', 'henryd@example.net', 'Group booking', 'We are a group of 15 people. Do you offer group discounts?', '2025-04-27', 0),
(9, 'Isla Brown', 'isbrown@aol.com', 'Breakfast options', 'Is breakfast included with the room rate?', '2025-04-28', 0),
(10, 'Jack Wilson', 'jackwilson@domain.com', 'Great experience', 'Had a wonderful stay! The staff were very helpful and friendly.', '2025-04-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `pnumber` varchar(10) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`sr_no`, `name`, `email`, `address`, `pnumber`, `pincode`, `dob`, `profile`, `password`, `t_expire`, `status`, `datentime`) VALUES
(1, 'kongpob', 'kongpob@gmail.com', 'BKK', '0982592063', 1234, '2025-06-27', 'IMG_685e3a70d15db3.84717049.jpg', '$2y$10$9ltG0hQQI.D/qWXxCz.L1uJbIPu/mq4GacrO2LfTdUa.QwOXEF1Qe', NULL, 1, '2025-06-27 13:30:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`book_detail_id`),
  ADD KEY `fk_booking_details_booking` (`booking_id`),
  ADD KEY `fk_booking_details_room` (`room_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking_order_user` (`user_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_proof`
--
ALTER TABLE `payment_proof`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_proof_booking` (`booking_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_covers`
--
ALTER TABLE `room_covers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid_cover` (`id_room`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `id facilities` (`id_facilities`),
  ADD KEY `id room` (`id_room`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `id features` (`id_features`),
  ADD KEY `room id` (`id_room`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid_image` (`id_room`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `book_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_proof`
--
ALTER TABLE `payment_proof`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_covers`
--
ALTER TABLE `room_covers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `fk_booking_details_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_details_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `fk_booking_order_user` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_proof`
--
ALTER TABLE `payment_proof`
  ADD CONSTRAINT `fk_payment_proof_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_covers`
--
ALTER TABLE `room_covers`
  ADD CONSTRAINT `rid_cover` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `id facilities` FOREIGN KEY (`id_facilities`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `id room` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `id features` FOREIGN KEY (`id_features`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `rid_image` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
