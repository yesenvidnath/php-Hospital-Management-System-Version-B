-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 05:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main_db_arogya`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `discharge_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `staff_id`, `room_id`, `appointment_date`, `appointment_time`, `discharge_date`) VALUES
(1, 5, 5, 1, '2023-05-01', '10:00:00', '2023-05-02'),
(2, 2, 4, 2, '2023-05-03', '12:00:00', '2023-05-05'),
(5, 3, 5, 1, '2023-05-26', '11:34:00', '2023-05-10'),
(6, 4, 5, 2, '2023-05-19', '12:36:00', '2023-05-20'),
(7, 1, 3, 3, '2023-05-11', '15:53:00', '2023-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `procedure_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `patient_id`, `staff_id`, `appointment_id`, `procedure_id`, `invoice_date`, `invoice_total`) VALUES
(3, 3, NULL, 5, NULL, '2023-05-18', '50000.00'),
(4, 3, NULL, 5, NULL, '2023-05-18', '50000.00');

-- --------------------------------------------------------

--
-- Table structure for table `operating_rooms`
--

CREATE TABLE `operating_rooms` (
  `operating_room_id` int(11) NOT NULL,
  `operating_room_name` varchar(255) NOT NULL,
  `availability` text NOT NULL,
  `operating_room_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operating_rooms`
--

INSERT INTO `operating_rooms` (`operating_room_id`, `operating_room_name`, `availability`, `operating_room_description`) VALUES
(1, 'Operating Room A', 'Not Available', 'This is the main operating room, equipped with advanced surgical tools and equipment.'),
(2, 'Operating Room B', 'Available', 'A secondary operating room used for less complex surgeries and procedures.'),
(3, 'Operating Room C', 'Available', 'A smaller operating room dedicated to minor surgeries and outpatient procedures.');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `medical_history` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `user_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `address`, `phone_number`, `email`, `medical_history`) VALUES
(0, NULL, 'Hamlen', 'Howerd', '2023-06-02', 'male', '51 karasnagala nikahatikanda weyangoda', '+94766588440', 'Ykandalama@gmail.com', 'ada'),
(1, 6, 'John', 'Doe', '1980-01-18', 'male', '123 Main St, Ohio USA', '123-456-7890', 'john.doe@email.com', 'Patient has a history of allergies, including an allergy to penicillin. They have also been diagnosed with seasonal allergies and have a history of hay fever.'),
(2, 7, 'Jane', 'Smith', '1985-03-15', '', '456 Park Ave, Anytown USA', '987-654-3210', 'jane.smith@email.com', 'Patient has a history of asthma and has been using an inhaler for several years. They have also been hospitalized for asthma-related issues in the past.'),
(3, 8, 'Bob', 'Johnson', '1990-07-20', 'Male', '789 Elm St, Anytown USA', '111-222-3333', 'bob.johnson@gmail.com', ''),
(4, 9, 'Alice', 'Davis', '1995-11-05', '', '123 Maple St, Anytown USA', '222-333-4444', 'alice.davis@email.com', 'The patient has been diagnosed with Type 2 diabetes and has been managing it with medication and a healthy diet. They have also been hospitalized for diabetic ketoacidosis in the past.'),
(5, 10, 'Mike', 'Brown', '2000-02-01', '', '456 Oak St, Anytown USA', '333-444-5555', 'mike.brown@email.com', 'Patient has a history of high blood pressure and has been prescribed medication to manage it. They have also been advised to make lifestyle changes, such as increasing physical activity and reducing salt intake.'),
(6, NULL, 'Jimmy', 'Migel', '2023-05-11', 'male', 'Ohio', '+94766588440', 'Migel@gmail.com', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `procedure_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `operating_room_id` int(11) NOT NULL,
  `procedure_name` varchar(50) DEFAULT NULL,
  `procedure_time` time DEFAULT NULL,
  `procedure_date` date DEFAULT NULL,
  `procedure_desc` varchar(100) DEFAULT NULL,
  `procedure_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`procedure_id`, `staff_id`, `patient_id`, `operating_room_id`, `procedure_name`, `procedure_time`, `procedure_date`, `procedure_desc`, `procedure_cost`) VALUES
(1, 2, 1, 1, 'Knee Replacement', '08:00:00', '2023-06-01', 'Total knee replacement surgery to alleviate pain and restore function in a severely diseased knee jo', '13000.00'),
(2, 3, 2, 2, 'Gallbladder Removal', '13:30:00', '2023-06-02', 'Laparoscopic cholecystectomy to remove the gallbladder due to the presence of gallstones causing pai', '8000.00'),
(3, 5, 3, 3, 'Hernia Repair', '10:00:00', '2023-06-03', 'Laparoscopic inguinal hernia repair to fix a protrusion of the intestine through a weak spot in the ', '7000.00'),
(4, 2, 4, 1, 'Appendectomy', '14:30:00', '2023-06-04', 'Laparoscopic appendectomy to remove an inflamed or infected appendix, preventing complications such ', '6000.00'),
(5, 3, 5, 2, 'Cataract Surgery', '09:00:00', '2023-06-05', 'Phacoemulsification cataract surgery to remove a clouded lens from the eye and replace it with an ar', '4500.00');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(50) DEFAULT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `max_capacity` int(11) DEFAULT NULL,
  `availability` enum('Available','Not available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `room_type`, `max_capacity`, `availability`) VALUES
(1, 'Room 1', 'Single', 3, 'Available'),
(2, 'Room 2', 'Double', 4, 'Available'),
(3, 'Room 3', 'Family', 6, 'Not available'),
(4, 'Room 4', 'Deluxe', 8, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `availability` enum('Available','Not available') DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `job_title`, `gender`, `phone_number`, `email`, `availability`, `user_id`) VALUES
(0, 'John', 'Doe', 'Doctor', 'male', '123-456-7890', 'john.doe@arogya.com', 'Available', NULL),
(2, 'Jane', 'Smith', 'Nurse', 'Female', '987-654-600', 'jane.smith@arogya.com', 'Not available', 2),
(3, 'Bob', 'Johnson', 'Doctor', 'male', '111-222-6666', 'bob.johnson@arogya.com', 'Available', 3),
(4, 'Alice', 'Davis', 'Nurse', 'Female', '444-555-6666', 'alice.davis@arogya.com', 'Available', 4),
(5, 'Mike', 'Wong', 'Doctor', 'male', '777-888-9999', 'mike.brown@arogya.com', 'Available', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `user_type` enum('staff','patient','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`) VALUES
(1, 'doctor_john', 'doctor_john_password', 'staff'),
(2, 'nurse_jane', 'nurse_jane_password', 'staff'),
(3, 'doctor_bob', 'doctor_bob_password', 'staff'),
(4, 'nurse_alice', 'nurse_alice_password', 'staff'),
(5, 'doctor_mike', 'doctor_mike_password', 'staff'),
(6, 'patient_john', 'patient_john_password', 'patient'),
(7, 'patient_jane', 'patient_jane_password', 'patient'),
(8, 'patient_bob', 'patient_bob_password', 'patient'),
(9, 'patient_alice', 'patient_alice_password', 'patient'),
(10, 'patient_mike', 'patient_mike_password', 'patient'),
(11, 'admin', 'admin_password', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `appointments_ibfk_1` (`patient_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `invoices_ibfk_3` (`appointment_id`),
  ADD KEY `fk_procedure_id` (`procedure_id`),
  ADD KEY `invoices_ibfk_1` (`patient_id`);

--
-- Indexes for table `operating_rooms`
--
ALTER TABLE `operating_rooms`
  ADD PRIMARY KEY (`operating_room_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`procedure_id`),
  ADD KEY `fk_procedures_staff` (`staff_id`),
  ADD KEY `fk_operating_rooms` (`operating_room_id`),
  ADD KEY `fk_procedures_patients` (`patient_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `operating_rooms`
--
ALTER TABLE `operating_rooms`
  MODIFY `operating_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `procedure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_procedure_id` FOREIGN KEY (`procedure_id`) REFERENCES `procedures` (`procedure_id`),
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `procedures`
--
ALTER TABLE `procedures`
  ADD CONSTRAINT `fk_operating_rooms` FOREIGN KEY (`operating_room_id`) REFERENCES `operating_rooms` (`operating_room_id`),
  ADD CONSTRAINT `fk_procedures_patients` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `fk_procedures_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
