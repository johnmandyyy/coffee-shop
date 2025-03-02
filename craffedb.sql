-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 05:20 PM
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
-- Database: `craffedb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTransactionHeader` (IN `register_id` INT)   BEGIN
    -- Insert the new row into the transaction_header table
    INSERT INTO `transaction_header` (`id`, `dot`, `ref_id`, `total_price`, `register_id`)
    VALUES (NULL, CURRENT_TIMESTAMP(), NULL, NULL, register_id);

    -- Return the ID of the inserted row
    SELECT LAST_INSERT_ID() AS inserted_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SetFreePrice` (IN `transaction_header_id` INT)   BEGIN

    UPDATE transaction_header
    SET transaction_header.total_price = 0
    WHERE id = transaction_header_id and ref_id = -1;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SetTotalPriceByID` (IN `transaction_header_id` INT)   BEGIN

	DECLARE user_reg_id INT;
    
    UPDATE transaction_header
    
    SET total_price = (
        SELECT SUM(debitables.price)
        FROM transaction_history
        INNER JOIN debitables
            ON debitables.id = transaction_history.debitable_id
        WHERE transaction_history.transaction_header_id = transaction_header_id
    ),
    
    name = (SELECT concat(first_name, ' ', last_name) from register where id = (
    	SELECT register_id FROM transaction_header WHERE id = transaction_header_id
    )),
    
    address = (SELECT address from register where id = (
    	SELECT register_id FROM transaction_header WHERE id = transaction_header_id
    )),
    
    mobile = (SELECT mobile from register where id = (
    	SELECT register_id FROM transaction_header WHERE id = transaction_header_id
    ))
    
    WHERE transaction_header.id = transaction_header_id;
    
    UPDATE previous_order
    
    	SET previous_order.total_price_of_all = 
        
            (SELECT SUM(debitables.price)
            FROM transaction_history
            INNER JOIN debitables
                ON debitables.id = transaction_history.debitable_id
            WHERE transaction_history.transaction_header_id = transaction_header_id)
        
    	WHERE previous_order.transaction_header_id = transaction_header_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateLoyaltyFlag` (IN `regid` INT)   BEGIN
    -- Declare variables for register_id and last_order_id
    DECLARE reg_id INT;
    DECLARE last_id INT;

    -- Set the register_id to 22
    SET @reg_id = regid;
	
    -- Check if the last_order_id is -1 for the given register_id
    IF (SELECT register.last_order_id FROM register WHERE id = @reg_id) = -1 THEN
        
        -- Modified Line
        IF (SELECT COUNT(*) FROM previous_order WHERE previous_order.register_id = @reg_id) != 0 AND MOD((SELECT COUNT(*) FROM previous_order WHERE previous_order.register_id = @reg_id), 10) = 0 THEN
        
            UPDATE register 

                SET register.loyalty_flag = 1, last_order_id = 
                (SELECT previous_order.id FROM previous_order WHERE previous_order.register_id = @reg_id ORDER by previous_order.id DESC LIMIT 1) 

            WHERE id = @reg_id;
     
    	END IF;
    
    END IF;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTransactionHistory` (IN `trans_id` INT)   BEGIN
    -- Update the transaction_history table
    UPDATE transaction_history
    SET item = (
        SELECT debitables.item
        FROM debitables
        WHERE debitables.id = transaction_history.debitable_id
    ),
    
    item_price = (
        SELECT debitables.price
        FROM debitables
        WHERE debitables.id = transaction_history.debitable_id
    )
    
    WHERE transaction_header_id = trans_id;
    
    UPDATE previous_order
    
        SET previous_order.register_id = (
            SELECT register_id FROM transaction_header WHERE
            transaction_header.id = trans_id
        )
    
    WHERE previous_order.transaction_header_id = trans_id;
    
    
    UPDATE debitables
        
        SET debitables.stocks = (debitables.stocks - 1)
        
        WHERE debitables.id IN 
        
        (SELECT debitable_id 
         FROM transaction_history 
         WHERE transaction_header_id = trans_id);
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `debitables`
--

CREATE TABLE `debitables` (
  `id` int(11) NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `stocks` int(11) DEFAULT NULL,
  `image_src` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debitables`
--

INSERT INTO `debitables` (`id`, `item`, `price`, `type`, `image`, `stocks`, `image_src`) VALUES
(1, 'Single Shot Espresso', 20, 'add_ons', NULL, 48, NULL),
(2, 'Sugar Syrup', 10, 'add_ons', NULL, 47, NULL),
(3, 'Vanilla Syrup', 10, 'add_ons', NULL, 46, NULL),
(4, 'Caramel Sauce', 10, 'add_ons', NULL, 45, NULL),
(5, 'Salted Caramel Sauce', 10, 'add_ons', NULL, 49, NULL),
(6, 'White Chocolate Sauce', 10, 'add_ons', NULL, 49, NULL),
(7, 'Chocolate Sauce', 10, 'add_ons', NULL, 50, NULL),
(8, 'Extra Milk', 15, 'add_ons', NULL, 49, NULL),
(9, 'Extra Jelly/Nata/Pearl', 10, 'add_ons', NULL, 45, NULL),
(10, 'Sub Oat Milk', 30, 'add_ons', NULL, 49, NULL),
(11, 'Chocolate Chip Cookies', 45, 'snacks', NULL, 37, '/coffee-shop/assets/product-items/cookies.webp'),
(12, 'Smores Cookies', 60, 'snacks', NULL, 44, '/coffee-shop/assets/product-items/smores.jpg'),
(13, 'Red Velvet Cookies', 55, 'snacks', NULL, 31, '/coffee-shop/assets/product-items/red-velvet.jpg'),
(14, 'Brownies', 35, 'snacks', NULL, 0, '/coffee-shop/assets/product-items/brownies.jpg'),
(15, 'Egg Tart', 25, 'snacks', NULL, 45, '/coffee-shop/assets/product-items/egg-tart.jpg'),
(16, 'Graham Bar', 45, 'snacks', NULL, 46, '/coffee-shop/assets/product-items/graham-bar.jpg'),
(17, 'Yema Cake', 100, 'snacks', NULL, 47, '/coffee-shop/assets/product-items/yema-cake.jpg'),
(18, 'Chocolate Cake', 100, 'snacks', NULL, 48, '/coffee-shop/assets/product-items/choco-cake.webp'),
(19, 'Ube Flan Cake', 110, 'snacks', NULL, 45, '/coffee-shop/assets/product-items/ube-cake.jpg'),
(20, 'Toasted Pastillas', 40, 'snacks', NULL, 48, '/coffee-shop/assets/product-items/toasted-pastillas.jpg'),
(21, 'Jelly Flan', 70, 'snacks', NULL, 42, '/coffee-shop/assets/product-items/jelly-flan.jpg'),
(22, 'Polvoron - Classic', 60, 'snacks', NULL, 50, '/coffee-shop/assets/product-items/polvoron.jpg'),
(23, 'Polvoron - Cookies and Cream', 65, 'snacks', NULL, 49, '/coffee-shop/assets/product-items/polvoron-cookies.jpg'),
(24, 'Iced - Americano 16 Oz', 75, 'iced_coffee', NULL, 30, NULL),
(25, 'Iced - Americano 22 Oz', 95, 'iced_coffee', NULL, 45, NULL),
(26, 'Iced - Craffeccino 16 Oz', 80, 'iced_coffee', NULL, 36, NULL),
(27, 'Iced - Craffeccino 22 Oz', 100, 'iced_coffee', NULL, 46, NULL),
(28, 'Iced - Cappuccino 16 Oz', 90, 'iced_coffee', NULL, 49, NULL),
(29, 'Iced - Cappuccino 22 Oz', 110, 'iced_coffee', NULL, 50, NULL),
(30, 'Iced - Flat White 16 Oz', 90, 'iced_coffee', NULL, 46, NULL),
(31, 'Iced - Flat White 22 Oz', 110, 'iced_coffee', NULL, 49, NULL),
(32, 'Iced - Vanilla Latte 16 Oz', 99, 'iced_coffee', NULL, 50, NULL),
(33, 'Iced - Vanilla Latte 22 Oz', 119, 'iced_coffee', NULL, 49, NULL),
(34, 'Iced - Spanish Latte 16 Oz', 99, 'iced_coffee', NULL, 50, NULL),
(35, 'Iced - Spanish Latte 22 Oz', 119, 'iced_coffee', NULL, 50, NULL),
(36, 'Iced - Mocha 16 Oz', 110, 'iced_coffee', NULL, 50, NULL),
(37, 'Iced - Mocha 22 Oz', 130, 'iced_coffee', NULL, 50, NULL),
(38, 'Iced - Caramel Macchiato 16 Oz', 110, 'iced_coffee', NULL, 50, NULL),
(39, 'Iced - Caramel Macchiato 22 Oz', 130, 'iced_coffee', NULL, 50, NULL),
(40, 'Iced - White Chocolate Mocha 16 Oz', 110, 'iced_coffee', NULL, 50, NULL),
(41, 'Iced - White Chocolate Mocha 22 Oz', 130, 'iced_coffee', NULL, 50, NULL),
(42, 'Iced - Salted Caramel 16 Oz', 110, 'iced_coffee', NULL, 50, NULL),
(43, 'Iced - Salted Caramel 22 Oz', 130, 'iced_coffee', NULL, 48, NULL),
(44, 'Hot - Americano', 75, 'hot_coffee', NULL, 46, NULL),
(45, 'Hot - Craffeccino', 80, 'hot_coffee', NULL, 38, NULL),
(46, 'Hot -Cappuccino', 90, 'hot_coffee', NULL, 47, NULL),
(47, 'Hot - Flat White', 90, 'hot_coffee', NULL, 50, NULL),
(48, 'Hot - Vanilla Latte', 99, 'hot_coffee', NULL, 50, NULL),
(49, 'Hot - Spanish Latte', 99, 'hot_coffee', NULL, 50, NULL),
(50, 'Hot - Mocha', 110, 'hot_coffee', NULL, 43, NULL),
(51, 'Hot - Caramel Macchiato', 110, 'hot_coffee', NULL, 49, NULL),
(52, 'Hot - White Chocolate Mocha', 110, 'hot_coffee', NULL, 50, NULL),
(53, 'Hot - Salted Caramel', 110, 'hot_coffee', NULL, 48, NULL),
(59, 'Bottled - Americano', 100, 'bottled_coffee', NULL, 28, NULL),
(60, 'Bottled - Craffeccino', 105, 'bottled_coffee', NULL, 35, NULL),
(61, 'Bottled - Cappuccino', 115, 'bottled_coffee', NULL, 35, NULL),
(62, 'Bottled - Flat White', 115, 'bottled_coffee', NULL, 38, NULL),
(63, 'Bottled - Vanilla Latte', 125, 'bottled_coffee', NULL, 39, NULL),
(64, 'Bottled - Spanish Latte', 125, 'bottled_coffee', NULL, 45, NULL),
(65, 'Bottled - Mocha', 135, 'bottled_coffee', NULL, 44, NULL),
(66, 'Bottled - Caramel Macchiato', 135, 'bottled_coffee', NULL, 47, NULL),
(67, 'Bottled - White Chocolate Mocha', 135, 'bottled_coffee', NULL, 49, NULL),
(68, 'Bottled - Salted Caramel', 135, 'bottled_coffee', NULL, 50, NULL),
(69, 'Wintermelon', 50, 'milktea', NULL, 23, NULL),
(70, 'Cookies n Cream', 50, 'milktea', NULL, 42, NULL),
(71, 'Taro', 50, 'milktea', NULL, 37, NULL),
(72, 'Red Velvet', 50, 'milktea', NULL, 42, NULL),
(73, 'Okinawa', 50, 'milktea', NULL, 39, NULL),
(74, 'Dark Chocolate', 50, 'milktea', NULL, 42, NULL),
(75, 'Strawberry Dreamscape', 100, 'frappe', NULL, 42, NULL),
(76, 'Choco Lush', 100, 'frappe', NULL, 41, NULL),
(77, 'Cookie Crumble', 100, 'frappe', NULL, 48, NULL),
(78, 'Matcha Bliss', 120, 'frappe', NULL, 42, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `debitables_coffee_based`
--

CREATE TABLE `debitables_coffee_based` (
  `id` int(11) NOT NULL,
  `debitable_id` int(11) DEFAULT NULL,
  `size` varchar(25) DEFAULT NULL,
  `category` varchar(25) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `primary_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debitables_coffee_based`
--

INSERT INTO `debitables_coffee_based` (`id`, `debitable_id`, `size`, `category`, `item_name`, `primary_item_id`) VALUES
(1, 24, '16', 'iced_coffee', 'Iced - Americano 16 Oz', 1),
(2, 26, '16', 'iced_coffee', 'Iced - Craffeccino 16 Oz', 2),
(3, 28, '16', 'iced_coffee', 'Iced - Cappuccino 16 Oz', 3),
(4, 30, '16', 'iced_coffee', 'Iced - Flat White 16 Oz', 4),
(5, 32, '16', 'iced_coffee', 'Iced - Vanilla Latte 16 Oz', 5),
(6, 34, '16', 'iced_coffee', 'Iced - Spanish Latte 16 Oz', 6),
(7, 36, '16', 'iced_coffee', 'Iced - Mocha 16 Oz', 7),
(8, 38, '16', 'iced_coffee', 'Iced - Caramel Macchiato 16 Oz', 8),
(9, 40, '16', 'iced_coffee', 'Iced - White Chocolate Mocha 16 Oz', 9),
(10, 42, '16', 'iced_coffee', 'Iced - Salted Caramel 16 Oz', 10),
(16, 25, '22', 'iced_coffee', 'Iced - Americano 22 Oz', 1),
(17, 27, '22', 'iced_coffee', 'Iced - Craffeccino 22 Oz', 2),
(18, 29, '22', 'iced_coffee', 'Iced - Cappuccino 22 Oz', 3),
(19, 31, '22', 'iced_coffee', 'Iced - Flat White 22 Oz', 4),
(20, 33, '22', 'iced_coffee', 'Iced - Vanilla Latte 22 Oz', 5),
(21, 35, '22', 'iced_coffee', 'Iced - Spanish Latte 22 Oz', 6),
(22, 37, '22', 'iced_coffee', 'Iced - Mocha 22 Oz', 7),
(23, 39, '22', 'iced_coffee', 'Iced - Caramel Macchiato 22 Oz', 8),
(24, 41, '22', 'iced_coffee', 'Iced - White Chocolate Mocha 22 Oz', 9),
(25, 43, '22', 'iced_coffee', 'Iced - Salted Caramel 22 Oz', 10),
(31, 44, '0', 'hot_coffee', 'Hot - Americano', 1),
(32, 45, '0', 'hot_coffee', 'Hot - Craffeccino', 2),
(33, 46, '0', 'hot_coffee', 'Hot -Cappuccino', 3),
(34, 47, '0', 'hot_coffee', 'Hot - Flat White', 4),
(35, 48, '0', 'hot_coffee', 'Hot - Vanilla Latte', 5),
(36, 49, '0', 'hot_coffee', 'Hot - Spanish Latte', 6),
(37, 50, '0', 'hot_coffee', 'Hot - Mocha', 7),
(38, 51, '0', 'hot_coffee', 'Hot - Caramel Macchiato', 8),
(39, 52, '0', 'hot_coffee', 'Hot - White Chocolate Mocha', 9),
(40, 53, '0', 'hot_coffee', 'Hot - Salted Caramel', 10),
(46, 59, '0', 'bottled_coffee', 'Bottled - Americano', 1),
(47, 60, '0', 'bottled_coffee', 'Bottled - Craffeccino', 2),
(48, 61, '0', 'bottled_coffee', 'Bottled - Cappuccino', 3),
(49, 62, '0', 'bottled_coffee', 'Bottled - Flat White', 4),
(50, 63, '0', 'bottled_coffee', 'Bottled - Vanilla Latte', 5),
(51, 64, '0', 'bottled_coffee', 'Bottled - Spanish Latte', 6),
(52, 65, '0', 'bottled_coffee', 'Bottled - Mocha', 7),
(53, 66, '0', 'bottled_coffee', 'Bottled - Caramel Macchiato', 8),
(54, 67, '0', 'bottled_coffee', 'Bottled - White Chocolate Mocha', 9),
(55, 68, '0', 'bottled_coffee', 'Bottled - Salted Caramel', 10);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `debitable_id` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `register_id` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `debitable_id`, `item`, `register_id`, `feedback`) VALUES
(1, 65, 'Bottled - Mocha', 57, 'Nays');

-- --------------------------------------------------------

--
-- Table structure for table `free_item`
--

CREATE TABLE `free_item` (
  `id` int(11) NOT NULL,
  `debitable_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `free_item`
--

INSERT INTO `free_item` (`id`, `debitable_id`, `item_name`) VALUES
(1, 26, 'Iced - Craffeccino 16 Oz');

-- --------------------------------------------------------

--
-- Table structure for table `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mission`
--

INSERT INTO `mission` (`id`, `value`) VALUES
(1, 'Sample Mission');

-- --------------------------------------------------------

--
-- Table structure for table `previous_order`
--

CREATE TABLE `previous_order` (
  `id` int(11) NOT NULL,
  `json_order` text DEFAULT NULL,
  `transaction_header_id` int(11) DEFAULT NULL,
  `dot` datetime DEFAULT NULL,
  `register_id` int(11) DEFAULT NULL,
  `has_feedback` tinyint(1) DEFAULT 0,
  `is_done` int(11) DEFAULT 0,
  `total_price_of_all` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `primary_items`
--

CREATE TABLE `primary_items` (
  `id` int(11) NOT NULL,
  `primary_item_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `primary_items`
--

INSERT INTO `primary_items` (`id`, `primary_item_name`) VALUES
(1, 'Americano'),
(2, 'Craffeccino'),
(3, 'Cappuccino'),
(4, 'Flat White'),
(5, 'Vanilla Latte'),
(6, 'Spanish Latte'),
(7, 'Mocha'),
(8, 'Caramel Macchiato'),
(9, 'White Chocolate Mocha'),
(10, 'Salted Caramel');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `loyalty_flag` int(11) NOT NULL DEFAULT 0,
  `address` text DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `order_count` int(11) DEFAULT 0,
  `is_admin` int(11) DEFAULT 0,
  `last_order_id` int(11) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`, `created_at`, `first_name`, `last_name`, `loyalty_flag`, `address`, `mobile`, `order_count`, `is_admin`, `last_order_id`) VALUES
(22, 'admin', 'kivik20641@hartaria.com', '$2y$10$kh13676r9NP84ettvF5CjuLhUBq7V7CUXrnOJW1JA7JOaRCXU9Z9e', '2024-11-05 13:31:28', 'SKT', 'Faker', 0, 'Lagro Lang', '09174211234', 0, 1, -1),
(51, 'user', 'test@gmail.com', '$2y$10$xcY1TVvg3mKp6qmp2deRHeT4qhO106TIupBd1bZeTguaydvFNDKke', '2024-11-13 10:11:05', 'Test', 'Surname', 1, 'Test Address', '09152313939', 0, 0, 8),
(52, 'donald', 'donald@gmail.com', '$2y$10$bqW1dv5MQ8ISFwSPh8BFFOhOv.ngmSxVCuPxMiq9dIBbdAnecFzDu', '2024-11-13 13:53:39', 'donald234', 'donald', 0, 'donald\n', '1231231', 0, 0, -1),
(53, 'mac', 'mac@gmail.com', '$2y$10$nhhhC75wFYqrvLOVVhjBXOIXjZQvA3uQgh1.MuHU4WwmIst5nIbQe', '2024-11-13 15:31:02', NULL, NULL, 0, NULL, NULL, 0, 0, -1),
(54, 'waw', 'waw@gmail.com', '$2y$10$nIChdCrS1C82l/czQuSKlOyk5l/prxYfqCtam4WZozIwHp591TxVi', '2024-11-13 15:35:05', NULL, NULL, 0, NULL, NULL, 0, 0, -1),
(55, 'sad', 'sad@gmail.com', '$2y$10$MMfa0Gp0zr47.VxIg/cO.esMOTjgB/iVnBA26xKNAsFetMImGM/1.', '2024-11-13 15:55:00', NULL, NULL, 0, NULL, NULL, 0, 0, -1),
(56, 'happy', 'happy@gmail.com', '$2y$10$TNgVZTI6oqI1YtjiXEWhZOm.uvp57pUd7zuUXCYmNxA.TJBYifbyG', '2024-11-13 15:57:37', NULL, NULL, 0, NULL, NULL, 0, 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_header`
--

CREATE TABLE `transaction_header` (
  `id` int(11) NOT NULL,
  `dot` datetime DEFAULT current_timestamp(),
  `ref_id` varchar(255) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `register_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `mode_of_pickup` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `receipt_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `transaction_header_id` int(11) DEFAULT NULL,
  `debitable_id` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `item_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vision`
--

CREATE TABLE `vision` (
  `id` int(11) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vision`
--

INSERT INTO `vision` (`id`, `value`) VALUES
(1, 'Sample Vision');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debitables`
--
ALTER TABLE `debitables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debitables_coffee_based`
--
ALTER TABLE `debitables_coffee_based`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debitable_id` (`debitable_id`),
  ADD KEY `primary_item_id` (`primary_item_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_item`
--
ALTER TABLE `free_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previous_order`
--
ALTER TABLE `previous_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `primary_items`
--
ALTER TABLE `primary_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transaction_header`
--
ALTER TABLE `transaction_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vision`
--
ALTER TABLE `vision`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debitables`
--
ALTER TABLE `debitables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `debitables_coffee_based`
--
ALTER TABLE `debitables_coffee_based`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `free_item`
--
ALTER TABLE `free_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `previous_order`
--
ALTER TABLE `previous_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `primary_items`
--
ALTER TABLE `primary_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `transaction_header`
--
ALTER TABLE `transaction_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vision`
--
ALTER TABLE `vision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debitables_coffee_based`
--
ALTER TABLE `debitables_coffee_based`
  ADD CONSTRAINT `debitables_coffee_based_ibfk_1` FOREIGN KEY (`debitable_id`) REFERENCES `debitables` (`id`),
  ADD CONSTRAINT `debitables_coffee_based_ibfk_2` FOREIGN KEY (`debitable_id`) REFERENCES `debitables` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `debitables_coffee_based_ibfk_3` FOREIGN KEY (`primary_item_id`) REFERENCES `primary_items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
