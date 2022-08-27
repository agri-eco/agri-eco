-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 04:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agri_eco_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `pax` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `rent_days` int(11) NOT NULL DEFAULT 0,
  `unli` varchar(250) NOT NULL DEFAULT 'None',
  `inclusion` varchar(255) NOT NULL DEFAULT 'None',
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Confirmed,2=Cancelled,3=Picked -up, 4 =Returned',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `enabler` varchar(250) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `user_id`, `package_id`, `pax`, `date_start`, `date_end`, `rent_days`, `unli`, `inclusion`, `cost`, `status`, `date_created`, `date_updated`, `enabler`) VALUES
(1, 7, 1, 10, '2022-07-31', '2022-07-31', 1, 'None', 'None', '2000.00', 0, '2022-07-31 16:05:15', NULL, 'off'),
(2, 14, 1, 10, '2022-08-02', '2022-08-02', 1, 'None', 'Whole Day Photoshoot', '9000.00', 3, '2022-08-02 09:08:18', '2022-08-02 09:23:09', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `inventory_id` int(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `status`, `date_created`) VALUES
(1, 'Bee Products', '', 1, '2022-05-26 12:15:13'),
(2, 'NCRDEC Products', '', 1, '2022-05-26 12:15:24'),
(3, 'SPRINT Products', '', 1, '2022-05-26 12:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(30) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `code` varchar(20) NOT NULL,
  `active` int(1) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `default_delivery_address` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `gender`, `contact`, `email`, `password`, `code`, `active`, `province`, `city`, `default_delivery_address`, `date_created`) VALUES
(7, 'Heroooo', 'Hernando', 'Male', '09123456789', 'lalalapweh@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '49238', 1, 'Cavite', 'Alfonso', 'Kaysuyo', '2022-07-31 10:30:09'),
(14, 'Test', 'Account', 'Male', '09123456789', 'emailsender329@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', '15642', 1, NULL, NULL, 'Kaysuyo', '2022-08-01 08:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `headlines`
--

CREATE TABLE `headlines` (
  `id` int(10) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `announcements` text DEFAULT NULL,
  `carousel` text CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headlines`
--

INSERT INTO `headlines` (`id`, `title`, `announcements`, `carousel`) VALUES
(14, 'CvSU receives a Plaque of Recognition from CHED', '<p>3,244&nbsp;total views, &nbsp;2,078&nbsp;views today The Commission on Higher Education (CHED) awarded Cavite State University a plaque of recognition on the 13th of June 2022 to acknowledge its efforts in providing free training on flexible learning for 146 Higher Education Institutions (HEIs) during the implementation of CHED’s Hi-Ed Bayanihan Project.<br></p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `upload_path` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `image_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `description`, `upload_path`, `image_name`, `status`, `date_created`) VALUES
(45, 'Admission Result: First Semester, SY 2022-2023', 'uploads1/package_45', 'OSAS.gif', 1, '2022-06-27 19:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(30) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `subject`, `message`, `status`, `date_created`) VALUES
(18, 'inquirer number 1', 'sample@sample', 'sample subject', 'sample msg', 1, '2022-07-28 13:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` double NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `quantity`, `price`, `date_created`, `date_updated`) VALUES
(1, 1, 10, '100.00', '2022-05-31 09:31:21', NULL),
(2, 2, 20, '130.00', '2022-05-31 09:31:31', NULL),
(3, 3, 15, '150.00', '2022-05-31 09:31:41', NULL),
(4, 4, 25, '120.00', '2022-05-31 09:31:53', NULL),
(5, 5, 30, '140.00', '2022-05-31 09:32:06', NULL),
(6, 6, 30, '140.00', '2022-05-31 09:32:25', NULL),
(7, 7, 30, '150.00', '2022-05-31 09:32:40', NULL),
(8, 8, 50, '150.34', '2022-05-31 09:33:03', '2022-07-31 11:48:41'),
(9, 9, 50, '200.00', '2022-05-31 09:34:29', NULL),
(10, 10, 50, '140.12', '2022-05-31 10:46:16', '2022-07-31 11:48:35'),
(13, 13, 50, '200.00', '2022-05-31 11:57:11', '2022-06-01 08:29:47'),
(14, 14, 20, '250.00', '2022-06-14 10:32:09', NULL),
(15, 15, 50, '250.56', '2022-06-14 11:36:13', '2022-07-31 10:04:28'),
(17, 17, 123, '123.00', '2022-06-14 11:49:40', NULL),
(20, 20, 30, '200.00', '2022-06-21 15:43:00', '2022-06-21 15:44:47'),
(21, 21, 1, '11.00', '2022-06-29 10:04:39', NULL),
(23, 23, 2, '12.00', '2022-07-20 08:31:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `payment_method` varchar(100) NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `order_type` tinyint(1) NOT NULL COMMENT '1= pickup,2= deliver',
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(30) NOT NULL,
  `title` text DEFAULT NULL,
  `tour_location` text DEFAULT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `upload_path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 =active ,2 = Inactive',
  `quantity` int(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `tour_location`, `min`, `max`, `cost`, `description`, `upload_path`, `status`, `quantity`, `date_created`) VALUES
(1, 'Tour package #1', NULL, 10, 15, '200.00', '&lt;ul&gt;&lt;li&gt;10-15 Person&lt;/li&gt;&lt;li&gt;Guided Tour&lt;/li&gt;&lt;li&gt;Light Snack&lt;/li&gt;&lt;li&gt;Animal Feeding&lt;/li&gt;&lt;li&gt;Brochure&lt;/li&gt;&lt;/ul&gt;', 'uploads/package_1', 1, 1, '2022-05-31 09:40:30'),
(2, 'Tour package #2', NULL, 5, 9, '250.00', '&lt;ul&gt;&lt;li&gt;5-9 Person&lt;/li&gt;&lt;li&gt;Guided Tour&lt;/li&gt;&lt;li&gt;Light Snack&lt;/li&gt;&lt;li&gt;Animal Feeding&lt;/li&gt;&lt;li&gt;Brochure&lt;/li&gt;&lt;/ul&gt;', 'uploads/package_2', 1, 1, '2022-05-31 09:44:39'),
(3, 'Tour package #3', NULL, 2, 4, '500.00', '&lt;ul&gt;&lt;li&gt;2-4 Person&lt;/li&gt;&lt;li&gt;Guided Tour&lt;/li&gt;&lt;li&gt;Light Snack&lt;/li&gt;&lt;li&gt;Animal Feeding&lt;/li&gt;&lt;li&gt;Brochure&lt;/li&gt;&lt;/ul&gt;', 'uploads/package_3', 1, 1, '2022-05-31 09:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `package_inclusion`
--

CREATE TABLE `package_inclusion` (
  `id` int(30) NOT NULL,
  `item` text DEFAULT NULL,
  `item_details` text DEFAULT NULL,
  `inclusion_cost` decimal(10,2) NOT NULL,
  `upload_path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_inclusion`
--

INSERT INTO `package_inclusion` (`id`, `item`, `item_details`, `inclusion_cost`, `upload_path`, `status`, `date_created`) VALUES
(6, 'Half Day Photoshoot', 'Maximum of 10 guests, 8am-1pm or 1pm-6pm, use of villa', '5000.00', 'uploads/package_6', 1, '2022-03-17 16:11:23'),
(7, 'Whole Day Photoshoot', 'Maximum of 10 guests, 8am-6pm, use of villa', '7000.00', 'uploads/package_7', 1, '2022-03-17 16:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `paid_order`
--

CREATE TABLE `paid_order` (
  `id` int(10) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid` int(10) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `department` text NOT NULL,
  `description` text NOT NULL,
  `upload_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `price`, `department`, `description`, `upload_path`, `status`, `date_created`) VALUES
(3, 1, 'Lotion', '0.00', 'Cavite State University', '&lt;p&gt;The HoneyBee lotion bar is our heaviest, balmiest, healing lotion for the most severe skin problems. Ours is a pure beeswax base with palm, coconut and sunflower oil.&lt;br&gt;&lt;/p&gt;', 'uploads/product_3', 1, '2022-05-31 09:15:46'),
(4, 1, 'Hand Sanitizer', '0.00', 'Cavite State University', '&lt;p&gt;Kill germs wherever you go and keep your hands moisturized with custom Honey Bee hand sanitizers and lotions from CVSU.&lt;br&gt;&lt;/p&gt;', 'uploads/product_4', 1, '2022-05-31 09:18:05'),
(5, 2, 'Liberica coffee ', '0.00', 'Cavite State University', '&lt;p&gt;Liberica coffee is a type of coffee that originated in Liberia, a country on the coast of West Africa. Liberica coffee plants are much larger then either Arabica or Robusta plants and the large coffee beans are known for their intense wood and smoky flavor.&lt;br&gt;&lt;/p&gt;', 'uploads/product_5', 1, '2022-05-31 09:22:11'),
(6, 2, 'Arabica coffee', '0.00', 'Cavite State University', '&lt;p&gt;Coffea arabica (/ ə ˈ r &aelig; b ɪ k ə /), also known as the Arabic coffee, is a species of flowering plant in the coffee and madder family Rubiaceae.It is believed to be the first species of coffee to have been cultivated, and is currently the dominant cultivar, representing about 60% of global production.&lt;br&gt;&lt;/p&gt;', 'uploads/product_6', 1, '2022-05-31 09:22:51'),
(7, 2, 'Excelsa Coffee', '0.00', 'Cavite State University', '&lt;p&gt;Excelsa coffee grows best at altitudes of between 1,000 and 1,300 m.a.s.l., and unlike arabica and robusta, it is an arboreal (tree-like) plant, rather than a shrub. This means it requires vertical space to grow, rather than growing into the area around it on the ground.&lt;br&gt;&lt;/p&gt;', 'uploads/product_7', 1, '2022-05-31 09:23:27'),
(8, 2, 'Robusta Coffee', '0.00', 'Cavite State University', '&lt;p&gt;Robusta has twice as much (or more) caffeine as arabica. Tastes different. Robusta tastes more bitter than arabica. This bitter flavor is in part due to the higher caffeine content. It&rsquo;s also higher in chlorogenic acid (CGA) which has a bitter flavor, it contains around 7-10% CGA, where Arabica has around 5.5-8%. CGA.&lt;br&gt;&lt;/p&gt;', 'uploads/product_8', 1, '2022-05-31 09:23:55'),
(10, 3, 'Kaong vinegar', '0.00', 'Cavite State University', '&lt;p&gt;Technicians of the CvSU&ndash;SPRINT have been teaching the farmers how to make brown sugar and syrup out of the kaong sap,so they can make their own brown sugar and syrup for sale or for home use.&lt;br&gt;&lt;/p&gt;', 'uploads/product_10', 1, '2022-05-31 10:45:17'),
(15, 1, 'Honey', '0.00', 'Cavite State University', '&lt;p&gt;Honey is a sweet liquid made by bees using nectar from flowers. People throughout the world have hailed the health benefits of honey for thousands of years.&lt;br&gt;&lt;/p&gt;', 'uploads/product_15', 1, '2022-06-14 11:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `rate_review`
--

CREATE TABLE `rate_review` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rate_review`
--

INSERT INTO `rate_review` (`id`, `user_id`, `package_id`, `rate`, `review`, `date_created`) VALUES
(1, 4, 3, 3, '&lt;p&gt;sample rate&lt;/p&gt;', '2022-07-28 14:02:31'),
(2, 14, 1, 3, '&lt;p&gt;3star&lt;/p&gt;', '2022-08-02 10:53:08'),
(3, 14, 1, 1, '&lt;p&gt;lalalal&lt;/p&gt;', '2022-08-02 11:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_info_retail`
--

CREATE TABLE `system_info_retail` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info_retail`
--

INSERT INTO `system_info_retail` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Agri-Eco Toursism Website'),
(6, 'short_name', 'Agri-Eco'),
(11, 'logo', 'uploads/1658977740_1.png'),
(18, 'cover', 'uploads/1656336000_IMG_4785.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `system_info_tour`
--

CREATE TABLE `system_info_tour` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info_tour`
--

INSERT INTO `system_info_tour` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Agri-Eco Tourism Management System'),
(6, 'short_name', 'Agri-Eco'),
(11, 'logo', 'uploads/1653962280_1650520080_1.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1653962280_1650520080_IMG_4785.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `type` int(1) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `type`, `active`, `last_login`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1647215160_bot_avatar.png', 1, 1, NULL, '2021-01-20 14:02:37', '2022-03-15 13:20:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headlines`
--
ALTER TABLE `headlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_inclusion`
--
ALTER TABLE `package_inclusion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid_order`
--
ALTER TABLE `paid_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_review`
--
ALTER TABLE `rate_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info_retail`
--
ALTER TABLE `system_info_retail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info_tour`
--
ALTER TABLE `system_info_tour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `description`
--
ALTER TABLE `description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `headlines`
--
ALTER TABLE `headlines`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package_inclusion`
--
ALTER TABLE `package_inclusion`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paid_order`
--
ALTER TABLE `paid_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_info_retail`
--
ALTER TABLE `system_info_retail`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_info_tour`
--
ALTER TABLE `system_info_tour`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
