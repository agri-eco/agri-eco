-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 01:35 PM
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
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `rent_days` int(11) NOT NULL DEFAULT 0,
  `unli` varchar(250) NOT NULL DEFAULT 'None',
  `inclusion` varchar(255) NOT NULL DEFAULT 'None',
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Confirmed,2=Cancelled,3=Picked -up, 4 =Returned',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `enabler` varchar(250) NOT NULL DEFAULT 'Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `user_id`, `package_id`, `date_start`, `date_end`, `rent_days`, `unli`, `inclusion`, `cost`, `status`, `date_created`, `date_updated`, `enabler`) VALUES
(5, 15, 7, '2022-06-22', '2022-06-23', 2, 'Unli Samgyupsal', 'Whole Day Photoshoot', '246.00', 1, '2022-06-21 16:18:40', '2022-06-21 16:18:56', 'Enable'),
(6, 15, 7, '2022-06-22', '2022-06-24', 3, 'None', 'Half Day Photoshoot', '369.00', 0, '2022-06-21 16:45:57', NULL, 'Enable');

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
(3, 'SPRINT Products', '', 1, '2022-05-26 12:15:44'),
(7, 'Trial category', '&lt;p&gt;Try&lt;/p&gt;', 1, '2022-06-21 15:41:33');

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
  `default_delivery_address` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `gender`, `contact`, `email`, `password`, `code`, `active`, `default_delivery_address`, `date_created`) VALUES
(1, 'Trial111', 'Account1111', 'Male', '09123456789', 'try.acc1two3@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '94857', 1, '111', '2022-06-16 10:29:45'),
(15, 'Demo', 'Account', 'Male', '09123456789', 'lalalapweh@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '45376', 1, '12345', '2022-06-19 22:09:16');

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
-- Table structure for table `frequent_asks`
--

CREATE TABLE `frequent_asks` (
  `id` int(30) NOT NULL,
  `question_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(8, 8, 50, '150.00', '2022-05-31 09:33:03', NULL),
(9, 9, 50, '200.00', '2022-05-31 09:34:29', NULL),
(10, 10, 50, '140.00', '2022-05-31 10:46:16', NULL),
(13, 13, 50, '200.00', '2022-05-31 11:57:11', '2022-06-01 08:29:47'),
(14, 14, 20, '250.00', '2022-06-14 10:32:09', NULL),
(15, 15, 50, '250.00', '2022-06-14 11:36:13', NULL),
(17, 17, 123, '123.00', '2022-06-14 11:49:40', NULL),
(20, 20, 30, '200.00', '2022-06-21 15:43:00', '2022-06-21 15:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `delivery_address` text NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `order_type` tinyint(1) NOT NULL COMMENT '1= pickup,2= deliver',
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `delivery_address`, `payment_method`, `product_id`, `order_type`, `amount`, `status`, `paid`, `date_created`, `date_updated`) VALUES
(1, 1, '', 'Cash on pick-up', NULL, 1, '440.00', 3, 0, '2022-06-21 15:53:27', '2022-06-21 15:53:47'),
(2, 15, 'adress', 'Cash on pick-up', NULL, 1, '300.00', 0, 0, '2022-06-21 16:31:01', NULL);

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
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, 1, 7, 2, '150.00', 300),
(2, 1, 10, 1, '140.00', 140),
(3, 2, 8, 1, '150.00', 150),
(4, 2, 3, 1, '150.00', 150);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(30) NOT NULL,
  `title` text DEFAULT NULL,
  `tour_location` text DEFAULT NULL,
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

INSERT INTO `packages` (`id`, `title`, `tour_location`, `cost`, `description`, `upload_path`, `status`, `quantity`, `date_created`) VALUES
(1, 'Tour package #1', NULL, '200.00', '&lt;ul&gt;&lt;li&gt;10-15 Person&lt;/li&gt;&lt;li&gt;Guided Tour&lt;/li&gt;&lt;li&gt;Light Snack&lt;/li&gt;&lt;li&gt;Animal Feeding&lt;/li&gt;&lt;li&gt;Brochure&lt;/li&gt;&lt;/ul&gt;', 'uploads/package_1', 1, 1, '2022-05-31 09:40:30'),
(2, 'Tour package #2', NULL, '250.00', '&lt;ul&gt;&lt;li&gt;5-9 Person&lt;/li&gt;&lt;li&gt;Guided Tour&lt;/li&gt;&lt;li&gt;Light Snack&lt;/li&gt;&lt;li&gt;Animal Feeding&lt;/li&gt;&lt;li&gt;Brochure&lt;/li&gt;&lt;/ul&gt;', 'uploads/package_2', 1, 1, '2022-05-31 09:44:39'),
(3, 'Tour package #3', NULL, '500.00', '&lt;ul&gt;&lt;li&gt;2-4 Person&lt;/li&gt;&lt;li&gt;Guided Tour&lt;/li&gt;&lt;li&gt;Light Snack&lt;/li&gt;&lt;li&gt;Animal Feeding&lt;/li&gt;&lt;li&gt;Brochure&lt;/li&gt;&lt;/ul&gt;', 'uploads/package_3', 1, 1, '2022-05-31 09:45:55'),
(7, 'Demo package', NULL, '123.00', '&lt;p&gt;Demo package&lt;/p&gt;', 'uploads/package_7', 1, 1, '2022-06-21 15:58:28');

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
  `sub_category_id` int(30) NOT NULL,
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

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `product_name`, `price`, `department`, `description`, `upload_path`, `status`, `date_created`) VALUES
(3, 1, 2, 'Lotion', '0.00', 'Cavite State University', '&lt;p&gt;The HoneyBee lotion bar is our heaviest, balmiest, healing lotion for the most severe skin problems. Ours is a pure beeswax base with palm, coconut and sunflower oil.&lt;br&gt;&lt;/p&gt;', 'uploads/product_3', 1, '2022-05-31 09:15:46'),
(4, 1, 2, 'Hand Sanitizer', '0.00', 'Cavite State University', '&lt;p&gt;Kill germs wherever you go and keep your hands moisturized with custom Honey Bee hand sanitizers and lotions from CVSU.&lt;br&gt;&lt;/p&gt;', 'uploads/product_4', 1, '2022-05-31 09:18:05'),
(5, 2, 6, 'Liberica coffee ', '0.00', 'Cavite State University', '&lt;p&gt;Liberica coffee is a type of coffee that originated in Liberia, a country on the coast of West Africa. Liberica coffee plants are much larger then either Arabica or Robusta plants and the large coffee beans are known for their intense wood and smoky flavor.&lt;br&gt;&lt;/p&gt;', 'uploads/product_5', 1, '2022-05-31 09:22:11'),
(6, 2, 3, 'Arabica coffee', '0.00', 'Cavite State University', '&lt;p&gt;Coffea arabica (/ ə ˈ r &aelig; b ɪ k ə /), also known as the Arabic coffee, is a species of flowering plant in the coffee and madder family Rubiaceae.It is believed to be the first species of coffee to have been cultivated, and is currently the dominant cultivar, representing about 60% of global production.&lt;br&gt;&lt;/p&gt;', 'uploads/product_6', 1, '2022-05-31 09:22:51'),
(7, 2, 5, 'Excelsa Coffee', '0.00', 'Cavite State University', '&lt;p&gt;Excelsa coffee grows best at altitudes of between 1,000 and 1,300 m.a.s.l., and unlike arabica and robusta, it is an arboreal (tree-like) plant, rather than a shrub. This means it requires vertical space to grow, rather than growing into the area around it on the ground.&lt;br&gt;&lt;/p&gt;', 'uploads/product_7', 1, '2022-05-31 09:23:27'),
(8, 2, 4, 'Robusta Coffee', '0.00', 'Cavite State University', '&lt;p&gt;Robusta has twice as much (or more) caffeine as arabica. Tastes different. Robusta tastes more bitter than arabica. This bitter flavor is in part due to the higher caffeine content. It&rsquo;s also higher in chlorogenic acid (CGA) which has a bitter flavor, it contains around 7-10% CGA, where Arabica has around 5.5-8%. CGA.&lt;br&gt;&lt;/p&gt;', 'uploads/product_8', 1, '2022-05-31 09:23:55'),
(10, 3, 8, 'Kaong vinegar', '0.00', 'Cavite State University', '&lt;p&gt;Technicians of the CvSU&ndash;SPRINT have been teaching the farmers how to make brown sugar and syrup out of the kaong sap,so they can make their own brown sugar and syrup for sale or for home use.&lt;br&gt;&lt;/p&gt;', 'uploads/product_10', 1, '2022-05-31 10:45:17'),
(15, 1, 1, 'Honey', '0.00', 'Cavite State University', '&lt;p&gt;Honey is a sweet liquid made by bees using nectar from flowers. People throughout the world have hailed the health benefits of honey for thousands of years.&lt;br&gt;&lt;/p&gt;', 'uploads/product_15', 1, '2022-06-14 11:36:02'),
(18, 1, 1, 'Sugar', '0.00', 'Cavite State University', '&lt;p&gt;Sugar&lt;/p&gt;', 'uploads/product_18', 1, '2022-06-15 19:29:05'),
(19, 3, 8, 'Sugarrrr', '0.00', 'Cavite State University', '&lt;p&gt;Sugar&lt;/p&gt;', 'uploads/product_19', 1, '2022-06-16 09:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(30) NOT NULL,
  `question` text DEFAULT NULL,
  `response_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `response_id`) VALUES
(1, 'what are you', 1),
(3, 'what is your name', 1),
(4, 'What can you do', 2),
(7, 'what is PHP', 4),
(8, 'What is ChatBot', 5),
(9, 'hi', 6),
(10, 'hello', 6),
(11, 'yow', 6),
(12, 'good day', 6),
(14, 'sample', 7),
(15, 'what topic can I ask', 8);

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
(1, 2, 1, 4, '&lt;p&gt;hhhh&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2022-06-15 13:42:54'),
(2, 15, 1, 5, '&lt;p&gt;package 1&lt;/p&gt;', '2022-06-20 22:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(30) NOT NULL,
  `response_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `response_message`) VALUES
(1, 'I am John, the chatBot of this application.'),
(2, 'I am in charge to answer your questions.'),
(3, 'You can ask me about something related to this website.'),
(4, 'PHP (recursive acronym for PHP: Hypertext Preprocessor ) is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.'),
(5, 'A chatbot is a software application used to conduct an on-line chat conversation via text or text-to-speech, in lieu of providing direct contact with a live human agent.'),
(6, 'Hi there, how can I help you ? :)'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, lectus non tincidunt viverra, lacus erat venenatis mauris, sed hendrerit libero diam ac tellus. Integer imperdiet massa lacus, sed porta ligula efficitur at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; '),
(8, 'You can ask me about something related to this website.');

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

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `order_id`, `total_amount`, `date_created`) VALUES
(1, 1, '710.00', '2022-06-15 14:55:31'),
(2, 2, '140.00', '2022-06-15 15:11:35'),
(5, 7, '250.00', '2022-06-15 15:54:04'),
(6, 14, '250.00', '2022-06-15 16:17:34'),
(7, 15, '140.00', '2022-06-15 16:19:13'),
(8, 16, '140.00', '2022-06-15 16:48:14'),
(9, 17, '140.00', '2022-06-15 18:05:32'),
(10, 18, '140.00', '2022-06-15 18:07:21'),
(11, 19, '140.00', '2022-06-15 18:08:04'),
(12, 20, '250.00', '2022-06-15 18:09:48'),
(13, 21, '120.00', '2022-06-15 18:28:09'),
(14, 1, '150.00', '2022-06-15 18:40:36'),
(15, 2, '140.00', '2022-06-15 19:00:58'),
(16, 3, '150.00', '2022-06-15 19:10:15'),
(20, 1, '440.00', '2022-06-21 15:53:27'),
(21, 2, '300.00', '2022-06-21 16:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(30) NOT NULL,
  `parent_id` int(30) NOT NULL,
  `sub_category` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `parent_id`, `sub_category`, `description`, `status`, `date_created`) VALUES
(1, 1, 'Edible', '', 1, '2022-05-26 12:16:21'),
(2, 1, 'Inedible', '', 1, '2022-05-26 12:16:28'),
(3, 2, 'Arabica ', '', 1, '2022-05-26 12:17:16'),
(4, 2, 'Robusta', '', 1, '2022-05-26 12:17:22'),
(5, 2, 'Excelsa ', '', 1, '2022-05-26 12:17:36'),
(6, 2, 'Liberica ', '', 1, '2022-05-26 12:17:43'),
(8, 3, 'Kaong', '', 1, '2022-05-26 12:19:34'),
(9, 6, 'Trial sub cat', '&lt;p&gt;Trial sub cat&lt;br&gt;&lt;/p&gt;', 1, '2022-05-31 11:56:01'),
(10, 7, 'Demo sub cat', '&lt;p&gt;Demo&lt;/p&gt;', 1, '2022-06-21 15:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `system_info_chat`
--

CREATE TABLE `system_info_chat` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info_chat`
--

INSERT INTO `system_info_chat` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Agri-Eco Toursism Chatbot'),
(4, 'intro', 'chat commands:\r\n-good day\r\n-hi\r\n-hello'),
(6, 'short_name', 'Agri-Eco'),
(10, 'no_result', 'You can contact me through http://localhost/agri_eco/tourism/?page=contact'),
(11, 'logo', 'uploads/1647151800_1.png'),
(12, 'bot_avatar', 'uploads/1647151800_bot_avatar2.png'),
(13, 'user_avatar', 'uploads/1647151560_user_icon.png');

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
(11, 'logo', 'uploads/1655630340_1.png'),
(18, 'cover', '../home_page/uploads/1655639100_2.jpg');

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
-- Table structure for table `unanswered`
--

CREATE TABLE `unanswered` (
  `id` int(30) NOT NULL,
  `question` text DEFAULT NULL,
  `no_asks` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1647215160_bot_avatar.png', 1, 1, NULL, '2021-01-20 14:02:37', '2022-03-15 13:20:40'),
(3, 'wawa', 'wawa', 'wawa', 'wawa', NULL, 1, 1, '2022-06-18 07:41:08', '2022-06-18 13:41:30', '2022-06-18 07:41:08');

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
-- Indexes for table `frequent_asks`
--
ALTER TABLE `frequent_asks`
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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_review`
--
ALTER TABLE `rate_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info_chat`
--
ALTER TABLE `system_info_chat`
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
-- Indexes for table `unanswered`
--
ALTER TABLE `unanswered`
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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `description`
--
ALTER TABLE `description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `frequent_asks`
--
ALTER TABLE `frequent_asks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headlines`
--
ALTER TABLE `headlines`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `system_info_chat`
--
ALTER TABLE `system_info_chat`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `unanswered`
--
ALTER TABLE `unanswered`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
