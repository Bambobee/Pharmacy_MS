-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 07:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`, `email`, `image`, `password`, `userType`, `last_seen`) VALUES
(1, 'ssewankambo derick', 'Ssewankamboderick@gamil.com', '1053245415.jpg', 'bdeb6e8ee39b6c70835993486c9e65dc', 'admin', '2023-06-20 13:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `name`, `image`, `message`) VALUES
(1, 'ssewankambo derick', 'no2.jpg', 'Wow this is the best pharmacy ever'),
(2, 'ssewankambo derick', 'no2.jpg', 'I hate this pharmacy for sure'),
(3, 'Dero pro', 'no1.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam inventore, necessitatibus ducimus quae soluta id nostrum molestiae tenetur hic cum, recusandae ea commodi? Rerum dolore consequatur nobis cupiditate eveniet ut!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `batch` varchar(200) NOT NULL,
  `user_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `name`, `price`, `image`, `qty`, `total_price`, `batch`, `user_id`) VALUES
(4, 'Paracetamol', '200', '1948853613.jpg', 2, '400', 'MC_000009', 1),
(5, 'Ampicillin', '100', '1875210536.jpg', 2, '200', 'MC_000002', 1),
(6, 'Clarithromycin', '500', '776217518.jpg', 3, '1500', 'MC_000003', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` varchar(14) NOT NULL,
  `featured` varchar(5) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `image`, `active`, `featured`, `date`) VALUES
(1, 'Liqiud', '1179995989.jpg', 'Yes', 'Yes', '2023-04-24 17:25:32'),
(2, 'Tablets', '192007940.jpg', 'Yes', 'Yes', '2023-04-24 17:26:01'),
(3, 'Capsules', '410305275.jpg', 'Yes', 'Yes', '2023-04-24 17:26:26'),
(4, 'TopicalMedicines', '1357812601.jpg', 'Yes', 'No', '2023-04-24 17:27:20'),
(5, 'Suppositories', '1873934767.jpg', 'Yes', 'No', '2023-04-24 17:27:53'),
(6, 'Drops', '189200421.jpg', 'Yes', 'Yes', '2023-04-24 17:28:20'),
(7, 'Inhalers', '1120135267.jpg', 'Yes', 'No', '2023-04-24 17:29:03'),
(8, 'Injections', '1635190456.jpeg', 'Yes', 'No', '2023-04-24 17:29:28'),
(9, 'Herbal', '1932606627.jpg', 'Yes', 'No', '2023-04-24 17:29:50'),
(10, 'Antibiotics', '249692122.jpg', 'Yes', 'No', '2023-04-25 11:34:18'),
(11, 'Caridovascular', '1621530026.jpg', 'Yes', 'Yes', '2023-04-25 11:35:08'),
(12, 'Gastro intestinal and ulcer', '791822363.jpg', 'Yes', 'No', '2023-04-25 11:39:14'),
(13, 'heartburn', '566521977.jpg', 'Yes', 'No', '2023-04-25 11:40:06'),
(14, 'Antihistaminic antidepressant ', '1752151023.jpg', 'Yes', 'Yes', '2023-04-25 11:41:24'),
(15, 'Antidiabtic Medicine', '1849731775.jpg', 'Yes', 'No', '2023-04-25 11:42:07'),
(16, 'Dietary supplement', '1715229716.jpg', 'Yes', 'No', '2023-04-25 11:43:06'),
(17, 'Cream or vasiline', '320526350.jpg', 'Yes', 'No', '2023-04-25 12:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_id`
--

CREATE TABLE `tbl_id` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_id`
--

INSERT INTO `tbl_id` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine`
--

CREATE TABLE `tbl_medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `batch` varchar(200) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `price` int(10) NOT NULL,
  `category` int(11) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` varchar(10) NOT NULL,
  `featured` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_medicine`
--

INSERT INTO `tbl_medicine` (`id`, `name`, `batch`, `description`, `price`, `category`, `date`, `image`, `active`, `featured`) VALUES
(1, 'Amoxyclin/Clavunic acid', 'MC_000001', '625mg\r\nIt reduces fever, pain and inflamation', 200, 1, '2023-04-26', '309219912.jpg', 'Yes', 'Yes'),
(2, 'Ampicillin', 'MC_000002', '500mg\r\nIt reduces fever, pain and inflation', 100, 2, '2023-04-26', '1875210536.jpg', 'Yes', 'Yes'),
(3, 'Clarithromycin', 'MC_000003', '480mg\r\nIt is used in the treatment of fungal infections', 500, 3, '2023-04-26', '776217518.jpg', 'Yes', 'Yes'),
(4, 'Co-tromoxazole', 'MC_000004', '700mg\r\nIt is used in the treatment of fungal infection', 300, 4, '2023-04-26', '1619822322.jpg', 'Yes', 'Yes'),
(5, 'Cephalexin', 'MC_000005', '100mg\r\nIt is used in nauseal and vomiting', 800, 8, '2023-04-26', '1575352063.jpg', 'Yes', 'No'),
(6, 'Doxycycline', 'MC_000006', '60mg\r\nIt is used in the treatment of flu and cough.', 500, 10, '2023-04-27', '1126957776.jpg', 'Yes', 'Yes'),
(7, 'Fluconazole', 'MC_000007', '300mg\r\nIt is used in the treatment of smallpox and other skin diseases', 1000, 17, '2023-04-27', '629788957.jpg', 'Yes', 'No'),
(8, 'Methacyclline HCI', 'MC_000008', '100mg\r\nIt is used to reduce headache and muscle pain', 2000, 15, '2023-04-28', '2138215946.jpg', 'Yes', 'No'),
(9, 'Paracetamol', 'MC_000009', 'For Headaches and muscle pain', 200, 2, '2023-05-09', '1948853613.jpg', 'Yes', 'Yes');

--
-- Triggers `tbl_medicine`
--
DELIMITER $$
CREATE TRIGGER `getID` BEFORE INSERT ON `tbl_medicine` FOR EACH ROW BEGIN
  INSERT INTO tbl_id VALUES (NULL);
  SET NEW.batch = CONCAT("MC_",LPAD(LAST_INSERT_ID(), 6,"0"));
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine_stock`
--

CREATE TABLE `tbl_medicine_stock` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `generic` varchar(100) NOT NULL,
  `packing` varchar(15) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `expiry` date NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_medicine_stock`
--

INSERT INTO `tbl_medicine_stock` (`id`, `name`, `generic`, `packing`, `batch`, `expiry`, `supplier`, `quantity`, `price`, `date`, `active`) VALUES
(5, 'acetylsalicylic', 'Oral liquid', '10tabs', 'PI123', '2023-05-13', 'Cadman Guzman', 43, 200, '2023-05-10', 'Yes'),
(6, 'Paracetamol', 'Suppository', '5tabs', 'GIE12', '2023-05-18', 'Quibusdam nesciunt ', 10, 1000, '2023-05-10', 'Yes'),
(7, 'Codeine', 'Tablet', '15tabs', 'PI123', '2023-05-26', 'Asperiores occaecat ', 8, 1000, '2023-05-10', 'Yes'),
(8, 'Morphine', 'Branden Gould', '10mg', 'GEI78', '2023-05-30', 'Asperiores occaecat ', 43, 7000, '2023-05-10', 'No'),
(9, 'cycline', 'Tempora autem duis i', '15tabs', 'GIE12', '2023-05-25', 'Tempore dignissimos', 70, 200, '2023-05-10', 'Yes'),
(10, 'dexamethasone', 'methasone', '20tabs', 'pe_78', '2023-06-01', 'Quibusdam nesciunt ', 20, 7000, '2023-05-10', 'Yes'),
(11, 'Ahmed', 'Incidunt delectus ', 'Qui maiores dol', 'Doloribus labore ips', '2018-07-22', 'In id iusto necessit', 778, 618, '2007-12-11', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`id`, `name`, `email`, `contact`, `subject`, `message`, `date`, `status`) VALUES
(4, 'Dero pro', 'rickrambo29@gmail.com', '+256 785555555', 'life', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni, iusto dolorum ea quo nesciunt minima incidunt deleniti quaerat sequi nemo earum inventore, voluptas ullam nisi placeat voluptatum, assumenda voluptatibus dolores.', '2023-06-01 20:14:18', 'Viewed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `order_no` varchar(50) DEFAULT NULL,
  `payment_method` varchar(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_receiver_address` text NOT NULL,
  `order_total_before_tax` decimal(10,2) NOT NULL,
  `order_total_tax1` decimal(10,2) NOT NULL,
  `order_total_tax2` decimal(10,2) NOT NULL,
  `order_total_tax` decimal(10,2) NOT NULL,
  `order_total_after_tax` decimal(10,2) NOT NULL,
  `order_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_no`, `payment_method`, `order_date`, `order_receiver_address`, `order_total_before_tax`, `order_total_tax1`, `order_total_tax2`, `order_total_tax`, `order_total_after_tax`, `order_datetime`) VALUES
(1, 'INV.NO_0000001', 'Cash', '2023-06-14', 'kawuku', 1000.00, 0.00, 0.00, 0.00, 1000.00, '2023-06-17 00:00:00'),
(2, 'INV.NO_0000002', 'Netbanking', '2023-06-20', '', 1400.00, 0.00, 0.00, 0.00, 1400.00, '2023-06-22 00:00:00');

--
-- Triggers `tbl_order`
--
DELIMITER $$
CREATE TRIGGER `countID` BEFORE INSERT ON `tbl_order` FOR EACH ROW BEGIN
  INSERT INTO test_id VALUES (NULL);
  SET NEW.order_no = CONCAT("INV.NO_" , LPAD(LAST_INSERT_ID(), 7, "0"));
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(14) NOT NULL,
  `products` varchar(300) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pmode` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'order',
  `image` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `name`, `email`, `contact`, `products`, `amount_paid`, `address`, `pmode`, `status`, `image`, `date`, `time`) VALUES
(1, 'Dero pro', 'rickrambo29@gmail.com', '+256 785555555', 'Co-tromoxazole(2), Amoxyclin/Clavunic acid(1), Fluconazole(1)', '1800', 'Kawuku-Bugiri', 'netbanking', 'Delivered', 'no1.jpg', '2023-05-31', '18:55:41'),
(2, 'Ssewankambo derick', 'ssewankamboderick@gmail.com', '0756856058', 'Paracetamol(2), Ampicillin(2), Clarithromycin(3)', '2100', 'matugga - Mabanda', 'cod', 'order', 'face girl.jpg', '2023-12-10', '09:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

CREATE TABLE `tbl_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_actual_amount` decimal(10,2) NOT NULL,
  `order_item_tax1_rate` decimal(10,2) NOT NULL,
  `order_item_tax1_amount` decimal(10,2) NOT NULL,
  `order_item_tax2_rate` decimal(10,2) NOT NULL,
  `order_item_tax2_amount` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order_item`
--

INSERT INTO `tbl_order_item` (`order_item_id`, `order_id`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_actual_amount`, `order_item_tax1_rate`, `order_item_tax1_amount`, `order_item_tax2_rate`, `order_item_tax2_amount`, `order_item_final_amount`) VALUES
(5, 1, 'panadal', 5.00, 200.00, 1000.00, 0.00, 0.00, 0.00, 0.00, 1000.00),
(6, 2, 'paracetamol', 4.00, 200.00, 800.00, 0.00, 0.00, 0.00, 0.00, 800.00),
(7, 2, 'Amoxilin', 2.00, 300.00, 600.00, 0.00, 0.00, 0.00, 0.00, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `medicine` varchar(200) NOT NULL,
  `price` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `payment` varchar(50) NOT NULL,
  `amount` int(20) NOT NULL,
  `paking` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`id`, `name`, `medicine`, `price`, `qty`, `voucher`, `date`, `payment`, `amount`, `paking`) VALUES
(5, 'ssewankambo derick', 'Panadal', '200', 4, 'GEIT12', '2023-05-31', 'Cash', 800, '12tabs');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `address` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `name`, `email`, `phone`, `address`, `date`) VALUES
(1, 'ssewankambo derick', 'ssewankamboderick@gmail.com', '0756856058', 'Matugga', '2023-04-16'),
(2, 'Aidan Ayala', 'raqedu@mailinator.com', '+1 (552) 942-1635', 'Dolorem eum ut autem', '2023-04-16'),
(4, 'Mohammad Erickson', 'rickrambo29@gmail.com', '+1 (776) 403-1754', 'Matugga', '2023-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `verification_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `address`, `contact`, `image`, `password`, `email_verified_at`, `verification_code`) VALUES
(1, 'Ssewankambo derick', 'ssewankamboderick@gmail.com', 'matugga - Mabanda', '0756856058', 'face girl.jpg', 'bdeb6e8ee39b6c70835993486c9e65dc', '2023-12-10 08:02:37', '152205');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `verification_code` text NOT NULL,
  `email_verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_id`
--

CREATE TABLE `test_id` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_id`
--

INSERT INTO `test_id` (`id`) VALUES
(1),
(2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_id`
--
ALTER TABLE `tbl_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_medicine`
--
ALTER TABLE `tbl_medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_medicine_stock`
--
ALTER TABLE `tbl_medicine_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_id`
--
ALTER TABLE `test_id`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_id`
--
ALTER TABLE `tbl_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_medicine`
--
ALTER TABLE `tbl_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_medicine_stock`
--
ALTER TABLE `tbl_medicine_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_id`
--
ALTER TABLE `test_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
