-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 01:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dqs`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_firstname` varchar(255) NOT NULL,
  `employee_lastname` varchar(255) NOT NULL,
  `employee_username` varchar(255) NOT NULL,
  `employee_password` varchar(255) NOT NULL,
  `employee_phone_no` varchar(255) NOT NULL,
  `employee_role` varchar(255) NOT NULL,
  `employee_profile_pic` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_firstname`, `employee_lastname`, `employee_username`, `employee_password`, `employee_phone_no`, `employee_role`, `employee_profile_pic`, `status`) VALUES
(1, 'test', 'test', 'manager', 'admin', '', 'manager', '', 'active'),
(9, '유', '지민', 'Karina', 'aespa', '', 'admin', '유 지민.jpg', 'active'),
(10, 'ジ', 'ゼル', 'Giselle', 'aespa', '', 'admin', '', 'active'),
(21, 'Guts', 'Bersek', 'Berserk', '12345', '', 'admin', '', 'active'),
(23, '김', '민정', 'Winter', 'aespa', '', 'admin', '', 'active'),
(25, 'Dragon', 'Ball', 'Goku', '12345', '', 'admin', '', 'active');

--
-- Triggers `employees`
--
DELIMITER $$
CREATE TRIGGER `before_employee_delete` BEFORE DELETE ON `employees` FOR EACH ROW BEGIN
    UPDATE orders
    SET order_status = 'redacted'
    WHERE employee_id = OLD.employee_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_employee_update` BEFORE UPDATE ON `employees` FOR EACH ROW BEGIN
    IF CONCAT(OLD.employee_firstname, ' ', OLD.employee_lastname) != CONCAT(NEW.employee_firstname, ' ', NEW.employee_lastname) THEN
        UPDATE orders
        SET order_status = 'redacted'
        WHERE employee_fullname = CONCAT(OLD.employee_firstname, ' ', OLD.employee_lastname)
          AND employee_id = OLD.employee_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_amount` decimal(10,2) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_fullname` varchar(255) NOT NULL,
  `order_placer_phone_no` varchar(255) NOT NULL,
  `order_placer_email` varchar(255) NOT NULL,
  `order_shipment_add` varchar(255) NOT NULL,
  `order_payment_method` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `status` varchar(50) DEFAULT 'active',
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `product_name`, `order_quantity`, `order_amount`, `employee_id`, `employee_fullname`, `order_placer_phone_no`, `order_placer_email`, `order_shipment_add`, `order_payment_method`, `order_status`, `status`, `order_date`) VALUES
(11, 29, 'Premium Corned Beef', 342, 0.00, 9, '유지민', '0930209032', 'ema@com', 'yestest', 'internal_payment', 'rejected', 'active', '2024-06-23'),
(12, 4, 'Cream O Deluxe - Vanilla Cream-Filled Chocolate Cookies with Fudgee Chocolate Topping 10 Packs', 23, 2419.60, 9, '유지민', '89093029', 'ema@com', 'yestest', 'bank_transfer', 'delivered', 'active', '2024-06-23'),
(13, 4, 'Cream O Deluxe - Vanilla Cream-Filled Chocolate Cookies with Fudgee Chocolate Topping 10 Packs', 23, 2419.60, 9, '유지민', '89093029', 'ema@com', 'Palompon,Brgy Leyte', 'company_account', 'delivered', 'active', '2024-06-23'),
(14, 4, 'Cream O Deluxe - Vanilla Cream-Filled Chocolate Cookies with Fudgee Chocolate Topping 10 Packs', 23, 2419.60, 9, '유지민', '89093029', 'ema@com', 'yestest', 'company_account', 'delivered', 'active', '2024-06-23'),
(15, 3, 'Cream O - Choco Cream-Filled Chocolate Sandwich Cookies 10 Packs', 12, 1099.56, 9, '유지민', '89093029', 'ema@com', 'yestest', 'electronic_payment', 'delivered', 'active', '2024-06-23'),
(16, 2, 'Presto Creams - Presto Creams Choco Peanut Butter 10 Packs', 23, 1496.15, 10, 'ジゼル', '09434242', 'ema@com', 'Palompon,Brgy Leyte', 'company_account', 'delivered', 'active', '2024-06-23'),
(17, 80, 'Orange - Orange Cream-Filled Chocolate Sandwich Cookies 10 Packs', 100, 6900.00, 9, '유지민', '093232132222', 'sample@sample.com', 'Samgyupsal, Korea', 'electronic_payment', 'delivered', 'active', '2024-07-01'),
(23, 4, 'Cream O Deluxe - Vanilla Cream-Filled Chocolate Cookies with Fudgee Chocolate Topping 10 Packs', 10, 1050.00, 1, 'testtest', '89093029', 'Abc@gmail.com', 'Samgyupsal, Korea', 'company_account', 'delivered', 'active', '2024-07-02'),
(31, 2, 'Presto Creams - Presto Creams Choco Peanut Butter 10 Packs', 23, 1495.00, 9, '유지민', '89093029', 'ema@com', 'Palompon,Brgy Leyte', 'company_account', 'delivered', 'active', '2024-07-02'),
(32, 89, 'Sample1', 4, 928.00, 9, '유지민', '3123123123', 'edward.camagong@wlcormoc.edu.ph', 'Samgyupsal, Korea', 'company_account', 'redacted', 'active', '2024-08-28'),
(33, 89, 'Sample1', 4, 928.00, 9, '유지민', '12312', 'ema@com', '213123', 'company_account', 'redacted', 'active', '2024-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_weight` float NOT NULL,
  `product_volume` float NOT NULL,
  `product_manufacturer` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_stock` int(11) UNSIGNED NOT NULL,
  `product_cost` decimal(10,0) NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_brand`, `product_price`, `product_weight`, `product_volume`, `product_manufacturer`, `product_category`, `product_stock`, `product_cost`, `product_photo`, `status`) VALUES
(2, 'Presto Creams - Presto Creams Choco Peanut Butter 10 Packs', 'Jackn Jill', 65.00, 300, 0, 'Universal Robina Corporation', 'Snacks', 11, 55, 'Presto Creams - Presto Creams Choco Peanut Butter 10 Packs300.jpg', 'active'),
(3, 'Cream O - Choco Cream-Filled Chocolate Sandwich Cookies 10 Packs', 'Jackn Jill', 92.00, 300, 0, 'Universal Robina Corporation', 'Snacks', 96, 78, 'Cream O - Choco Cream-Filled Chocolate Sandwich Cookies 10 Packs300.jpeg', 'active'),
(4, 'Cream O Deluxe - Vanilla Cream-Filled Chocolate Cookies with Fudgee Chocolate Topping 10 Packs', 'Jackn Jill', 105.00, 330, 0, 'Universal Robina Corporation', 'Snacks', 5, 89, 'Cream O Deluxe - Vanilla Cream-Filled Chocolate Cookies with Fudgee Chocolate Topping 10 Packs330.png', 'active'),
(27, 'Premium Corned Beef', 'Virginia', 127.00, 220, 0, 'Virginia Food, Inc', 'Canned Goods', 96, 108, 'Premium Corned Beef220.jpg', 'active'),
(29, 'Premium Corned Beef', 'Virginia', 72.00, 150, 0, 'Virginia Food, Inc', 'Canned Goods', 95, 61, 'Premium Corned Beef150.jpg', 'active'),
(79, 'Presto Creams - Presto Creams Peanut Butter Sandwich Cookies 10 Packs', 'Jackn Jill', 61.00, 300, 0, 'Universal Robina Corporation', 'Snacks', 95, 52, 'Presto Creams - Presto Creams Peanut Butter Sandwich Cookies 10 Packs300.jpg', 'active'),
(80, 'Bingo Orange - Orange Cream-Filled Chocolate Sandwich Cookies 10 Packs', 'Bingo', 69.00, 280, 0, 'Monde Nissin Corporation', 'Snacks', 92, 59, 'Bingo Orange - Orange Cream-Filled Chocolate Sandwich Cookies 10 Packs280.jpg', 'active'),
(81, 'Bingo Vanilla - Vanilla Cream-Filled Chocolate Sandwich Cookies 10 Packs', 'Bingo', 64.00, 280, 0, 'Monde Nissin Corporation', 'Snacks', 7, 54, 'Bingo Vanilla - Vanilla Cream-Filled Chocolate Sandwich Cookies 10 Packs280.png', 'active'),
(82, 'Summit Natural Drinking Water', 'Summit', 23.00, 0, 1000, 'Asia Brewery Incorporated', 'Water', 82, 20, '', 'active'),
(83, 'Summit Natural Drinking Water', 'Summit', 15.00, 0, 500, 'Asia Brewery Incorporated ', 'Water', 93, 13, 'Summit Natural Drinking Water500.jpg', 'active'),
(84, 'Absolute Pure Drinking Water', 'Absolute Pure Drinking Water', 28.00, 0, 1000, 'Asia Brewery Incorporated', 'Water', 88, 24, 'Absolute Pure Drinking Water1000.jpg', 'active'),
(85, 'Absolute Pure Drinking Water', 'Absolute', 17.00, 0, 500, 'Asia Brewery Incorporated', 'Water', 65, 14, '', 'active'),
(86, 'Pringles Original', 'Pringles', 45.00, 42, 0, 'Kellanova', 'Chips', 94, 38, 'Pringles Original42.jpg', 'active'),
(87, 'Pringles Original', 'Pringles', 85.00, 107, 0, 'Kellanova', 'Chips', 85, 72, 'Pringles Original107.jpeg', 'active'),
(88, 'Piattos - Cheese - Flavored Potatoe Crisps', 'Jackn Jill', 40.00, 15, 0, 'Universal Robina Corporation', 'Chips', 72, 34, 'Piattos Cheese - Flavored Potatoe Crisps15.jpg', 'active');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `before_product_delete` BEFORE DELETE ON `products` FOR EACH ROW BEGIN
    UPDATE orders
    SET order_status = 'redacted'
    WHERE product_id = OLD.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `purchase_time` time NOT NULL,
  `purchase_quantity` int(11) NOT NULL,
  `purchase_total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `customer_id`, `purchase_date`, `purchase_time`, `purchase_quantity`, `purchase_total_amount`, `payment_method`) VALUES
(88, 1, '2024-07-01', '02:17:58', 3, 262.00, 'Grab'),
(89, 2, '2024-07-01', '02:20:28', 4, 367.00, 'GCash'),
(90, 3, '2024-07-01', '02:20:55', 3, 262.00, 'Coins.ph'),
(91, 4, '2024-07-01', '03:40:06', 4, 323.00, 'Coins.ph'),
(92, 5, '2024-07-01', '02:43:13', 3, 249.00, 'Grab'),
(93, 6, '2024-07-01', '04:47:55', 3, 192.00, 'Cash'),
(94, 7, '2024-07-01', '04:48:47', 27, 2484.00, 'GCash'),
(95, 8, '2024-07-01', '06:19:53', 3, 239.00, 'Grab'),
(96, 1, '2024-07-02', '08:14:23', 11, 245.00, 'GCash'),
(97, 1, '2024-07-16', '05:52:38', 16, 1043.00, 'Maya'),
(98, 2, '2024-07-16', '05:55:12', 20, 1260.00, 'Cash'),
(100, 3, '2024-07-16', '05:55:46', 17, 726.00, 'Grab'),
(101, 4, '2024-07-16', '05:56:28', 2, 130.00, 'Cash'),
(102, 1, '2024-07-21', '04:50:09', 6, 231.00, 'Dito'),
(103, 2, '2024-07-21', '05:00:18', 2, 130.00, 'Debit'),
(104, 3, '2024-07-21', '05:03:31', 2, 80.00, 'Maya'),
(105, 1, '2024-08-28', '10:05:43', 7, 459.00, 'Maya'),
(108, 1, '2024-09-04', '10:52:18', 4, 279.00, 'Grab'),
(109, 1, '2024-10-07', '04:08:00', 6, 510.00, 'Cash'),
(110, 2, '2024-10-07', '04:43:45', 11, 253.00, 'Coins.ph'),
(111, 1, '2024-10-16', '06:16:36', 4, 260.00, 'Grab'),
(112, 1, '2024-11-13', '02:24:42', 4, 260.00, 'GCash');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `sales_detail_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`sales_detail_id`, `sales_id`, `product_id`, `product_quantity`, `product_price`) VALUES
(95, 88, 2, 1, 65.00),
(96, 88, 3, 1, 92.00),
(97, 88, 4, 1, 105.00),
(98, 89, 2, 1, 65.00),
(99, 89, 3, 1, 92.00),
(100, 89, 4, 2, 105.00),
(101, 90, 2, 1, 65.00),
(102, 90, 3, 1, 92.00),
(103, 90, 4, 1, 105.00),
(104, 91, 2, 1, 65.00),
(105, 91, 3, 1, 92.00),
(106, 91, 4, 1, 105.00),
(107, 91, 79, 1, 61.00),
(108, 92, 2, 1, 65.00),
(109, 92, 3, 2, 92.00),
(110, 93, 81, 3, 64.00),
(111, 94, 3, 27, 92.00),
(112, 95, 2, 1, 65.00),
(113, 95, 4, 1, 105.00),
(114, 95, 80, 1, 69.00),
(115, 96, 83, 4, 15.00),
(116, 96, 84, 6, 28.00),
(117, 96, 85, 1, 17.00),
(118, 97, 81, 2, 64.00),
(119, 97, 80, 3, 69.00),
(120, 97, 3, 1, 92.00),
(121, 97, 2, 1, 65.00),
(122, 97, 27, 2, 127.00),
(123, 97, 29, 1, 72.00),
(124, 97, 86, 1, 45.00),
(125, 97, 87, 1, 85.00),
(126, 97, 88, 1, 40.00),
(127, 97, 85, 1, 17.00),
(128, 97, 83, 1, 15.00),
(129, 97, 82, 1, 23.00),
(130, 98, 3, 2, 92.00),
(131, 98, 2, 3, 65.00),
(132, 98, 4, 2, 105.00),
(133, 98, 79, 1, 61.00),
(134, 98, 80, 1, 69.00),
(135, 98, 81, 1, 64.00),
(136, 98, 29, 3, 72.00),
(137, 98, 27, 1, 127.00),
(138, 98, 83, 1, 15.00),
(139, 98, 84, 2, 28.00),
(140, 98, 85, 1, 17.00),
(141, 98, 82, 2, 23.00),
(142, 100, 88, 4, 40.00),
(143, 100, 87, 1, 85.00),
(144, 100, 86, 2, 45.00),
(145, 100, 85, 2, 17.00),
(146, 100, 84, 4, 28.00),
(147, 100, 82, 2, 23.00),
(148, 100, 29, 1, 72.00),
(149, 100, 27, 1, 127.00),
(150, 101, 2, 2, 65.00),
(151, 102, 86, 1, 45.00),
(152, 102, 87, 1, 85.00),
(153, 102, 88, 1, 40.00),
(154, 102, 83, 1, 15.00),
(155, 102, 82, 2, 23.00),
(156, 103, 87, 1, 85.00),
(157, 103, 86, 1, 45.00),
(158, 104, 88, 2, 40.00),
(159, 105, 2, 2, 65.00),
(160, 105, 79, 2, 61.00),
(161, 105, 80, 3, 69.00),
(162, 108, 2, 1, 65.00),
(163, 108, 3, 1, 92.00),
(164, 108, 79, 2, 61.00),
(165, 109, 2, 3, 65.00),
(166, 109, 4, 3, 105.00),
(167, 110, 82, 11, 23.00),
(168, 111, 2, 4, 65.00),
(169, 112, 2, 4, 65.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `foreign_key` (`employee_id`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `uc_product_name_weight_volume` (`product_name`,`product_weight`,`product_volume`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD UNIQUE KEY `customer_and_time_constriant` (`customer_id`,`purchase_date`) USING BTREE;

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`sales_detail_id`),
  ADD KEY `sales_id` (`sales_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `sales_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
