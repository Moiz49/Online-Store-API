-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 02:19 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Username`, `Password`) VALUES
('hashir', '5678'),
('moiz', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `admin_material_order`
--

CREATE TABLE `admin_material_order` (
  `Username` varchar(255) NOT NULL,
  `Mat_Id` int(11) NOT NULL,
  `SO_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_material_order`
--

INSERT INTO `admin_material_order` (`Username`, `Mat_Id`, `SO_Id`) VALUES
('hashir', 69, 11),
('moiz', 69, 22),
('moiz', 233, 22);

-- --------------------------------------------------------

--
-- Table structure for table `art_item`
--

CREATE TABLE `art_item` (
  `Art_Id` int(11) NOT NULL,
  `Art_name` varchar(255) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Type_` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `art_item`
--

INSERT INTO `art_item` (`Art_Id`, `Art_name`, `Quantity`, `Price`, `Type_`) VALUES
(1, 'Christmas Light', 6, 15, 1),
(2, 'moiz', 3, 35, 1),
(3, 'ring', 13, 9, 2),
(4, 'earrings', 7, 25, 2),
(5, 'Christmas decorations', 4, 15, 1),
(6, 'necklese', 4, 50, 2),
(7, 'Cocaine', 18, 300, 2);

-- --------------------------------------------------------

--
-- Table structure for table `art_item_made_from`
--

CREATE TABLE `art_item_made_from` (
  `Art_Id` int(11) NOT NULL,
  `Mat_Id` int(11) NOT NULL,
  `M_qty_each_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `art_item_made_from`
--

INSERT INTO `art_item_made_from` (`Art_Id`, `Mat_Id`, `M_qty_each_item`) VALUES
(7, 69, 5),
(5, 233, 10);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_Id` int(11) NOT NULL,
  `Name_` varchar(255) NOT NULL,
  `Email_address` varchar(255) DEFAULT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_Id`, `Name_`, `Email_address`, `Address`) VALUES
(101, 'Joey', 'joey@gmial.com', '111 death street Gotham City'),
(102, 'Michael', 'michael@gmail.com', '1725 Slough Avenue Scranton'),
(103, 'Jeff', 'jeff@gmail.com', '2020 hollywood blvd'),
(104, 'Batman', 'batman@gmail.com', '2020 saudi street');

-- --------------------------------------------------------

--
-- Table structure for table `manage_inventory`
--

CREATE TABLE `manage_inventory` (
  `Username` varchar(255) NOT NULL,
  `Mat_Id` int(11) NOT NULL,
  `M_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_inventory`
--

INSERT INTO `manage_inventory` (`Username`, `Mat_Id`, `M_qty`) VALUES
('hashir', 233, 7),
('moiz', 69, 10),
('moiz', 233, 2);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `Mat_Id` int(11) NOT NULL,
  `Mat_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`Mat_Id`, `Mat_name`) VALUES
(69, 'Soft Balls'),
(233, 'sticks');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Final_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_Id`, `Customer_id`, `Final_cost`) VALUES
(111, 102, 0),
(222, 103, 0),
(333, 104, 0),
(444, 104, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_contains`
--

CREATE TABLE `order_contains` (
  `Order_id` int(11) NOT NULL,
  `Art_Id` int(11) NOT NULL,
  `Art_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_contains`
--

INSERT INTO `order_contains` (`Order_id`, `Art_Id`, `Art_qty`) VALUES
(111, 2, 1),
(111, 7, 1),
(222, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Customer_Id` int(11) NOT NULL,
  `Art_Id` int(11) NOT NULL,
  `Cname` varchar(255) DEFAULT NULL,
  `Review` varchar(255) DEFAULT NULL,
  `Date_` varchar(255) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Customer_Id`, `Art_Id`, `Cname`, `Review`, `Date_`, `Rating`) VALUES
(101, 3, 'Joe', 'Great!!', 'June 22, 2020', 4),
(104, 7, 'Batman', 'Good stuff', 'May 11, 2020', 5);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `Order_Id` int(11) NOT NULL,
  `Status_` varchar(255) DEFAULT NULL,
  `Scompany` varchar(255) DEFAULT NULL,
  `Ship_date` varchar(255) DEFAULT NULL,
  `Destination` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`Order_Id`, `Status_`, `Scompany`, `Ship_date`, `Destination`) VALUES
(111, 'Stroge', 'UPS', 'July 7, 2020', 'Calgary'),
(222, 'SENT', 'UPS', 'May 12, 2020', 'Calgary');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `Customer_Id` int(11) NOT NULL,
  `Total_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`Customer_Id`, `Total_cost`) VALUES
(101, 0),
(103, 0),
(104, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_contains`
--

CREATE TABLE `shopping_cart_contains` (
  `Customer_Id` int(11) NOT NULL,
  `Art_Id` int(11) NOT NULL,
  `Art_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart_contains`
--

INSERT INTO `shopping_cart_contains` (`Customer_Id`, `Art_Id`, `Art_qty`) VALUES
(101, 6, 5),
(103, 1, 2),
(104, 1, 1),
(104, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supply_order`
--

CREATE TABLE `supply_order` (
  `SO_Id` int(11) NOT NULL,
  `Supplier_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supply_order`
--

INSERT INTO `supply_order` (`SO_Id`, `Supplier_name`) VALUES
(11, 'Canadian tire'),
(22, 'Walmart');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `admin_material_order`
--
ALTER TABLE `admin_material_order`
  ADD PRIMARY KEY (`Username`,`Mat_Id`,`SO_Id`),
  ADD KEY `Mat_Id` (`Mat_Id`),
  ADD KEY `SO_Id` (`SO_Id`);

--
-- Indexes for table `art_item`
--
ALTER TABLE `art_item`
  ADD PRIMARY KEY (`Art_Id`);

--
-- Indexes for table `art_item_made_from`
--
ALTER TABLE `art_item_made_from`
  ADD PRIMARY KEY (`Mat_Id`,`Art_Id`),
  ADD KEY `Art_Id` (`Art_Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_Id`);

--
-- Indexes for table `manage_inventory`
--
ALTER TABLE `manage_inventory`
  ADD PRIMARY KEY (`Username`,`Mat_Id`),
  ADD KEY `Mat_Id` (`Mat_Id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`Mat_Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `order_contains`
--
ALTER TABLE `order_contains`
  ADD PRIMARY KEY (`Order_id`,`Art_Id`),
  ADD KEY `Art_Id` (`Art_Id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Customer_Id`,`Art_Id`),
  ADD KEY `Art_Id` (`Art_Id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`Order_Id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`Customer_Id`);

--
-- Indexes for table `shopping_cart_contains`
--
ALTER TABLE `shopping_cart_contains`
  ADD PRIMARY KEY (`Customer_Id`,`Art_Id`),
  ADD KEY `Art_Id` (`Art_Id`);

--
-- Indexes for table `supply_order`
--
ALTER TABLE `supply_order`
  ADD PRIMARY KEY (`SO_Id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_material_order`
--
ALTER TABLE `admin_material_order`
  ADD CONSTRAINT `admin_material_order_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `admins` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_material_order_ibfk_2` FOREIGN KEY (`Mat_Id`) REFERENCES `material` (`Mat_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_material_order_ibfk_3` FOREIGN KEY (`SO_Id`) REFERENCES `supply_order` (`SO_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `art_item_made_from`
--
ALTER TABLE `art_item_made_from`
  ADD CONSTRAINT `art_item_made_from_ibfk_1` FOREIGN KEY (`Art_Id`) REFERENCES `art_item` (`Art_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `art_item_made_from_ibfk_2` FOREIGN KEY (`Mat_Id`) REFERENCES `material` (`Mat_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_inventory`
--
ALTER TABLE `manage_inventory`
  ADD CONSTRAINT `manage_inventory_ibfk_1` FOREIGN KEY (`Mat_Id`) REFERENCES `material` (`Mat_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_inventory_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `admins` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_contains`
--
ALTER TABLE `order_contains`
  ADD CONSTRAINT `order_contains_ibfk_1` FOREIGN KEY (`Art_Id`) REFERENCES `art_item` (`Art_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_contains_ibfk_2` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Art_Id`) REFERENCES `art_item` (`Art_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`Customer_Id`) REFERENCES `customer` (`Customer_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_ibfk_1` FOREIGN KEY (`Order_Id`) REFERENCES `orders` (`Order_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`Customer_Id`) REFERENCES `customer` (`Customer_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_cart_contains`
--
ALTER TABLE `shopping_cart_contains`
  ADD CONSTRAINT `shopping_cart_contains_ibfk_1` FOREIGN KEY (`Customer_Id`) REFERENCES `customer` (`Customer_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shopping_cart_contains_ibfk_2` FOREIGN KEY (`Art_Id`) REFERENCES `art_item` (`Art_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
