-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 03:10 AM
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
-- Database: `horizontech`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) DEFAULT NULL,
                            `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
                                                         (1, 'Keyboards', 'this category offers many keyboards in this store and it\'s amazing quality'),
(2, 'HDD/SDD', 'this category offers some of storage units that surely you need in your computer.'),
(3, 'RAMs', 'this category offers run time storage units that you need in your computer and add some speed to your computer\'s performance.'),
                                                         (4, 'Headphones', 'this category offers many of quality headphones in our computer\'s store.');

-- --------------------------------------------------------

--
-- Table structure for table `images_product`
--

CREATE TABLE `images_product` (
  `id` int(11) NOT NULL,
  `path` varchar(750) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images_product`
--

INSERT INTO `images_product` (`id`, `path`, `product_id`) VALUES
(1, '/keyboards/1.jpg', 2),
(2, '/keyboards/2.jpg', 2),
(3, '/keyboards/4.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `is_complete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `tag` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `quantity_aval` int(11) NOT NULL DEFAULT 0
) ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `manufacturer`, `description`, `cat_id`, `date_added`, `tag`, `quantity`, `quantity_aval`) VALUES
(2, 'Gaming KeyBoard with Lighting Effects\r\n', 20, 'Intel', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aliquam asperiores aspernatur dolorum, ea enim ex laudantium libero molestias numquam pariatur quam qui rem repellendus soluta suscipit ut veniam?Accusantium alias animi asperiores, autem blanditiis consequuntur culpa deleniti distinctio dolore id impedit laudantium mollitia nesciunt non nostrum officia optio placeat praesentium quaerat sed sunt totam unde vero voluptas voluptatem\r\n', 1, '2024-06-07', 'Mechnical Keyboard', 60, 40),
(3, 'Headphones with powerful sound effects', 10, 'Z-company', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aliquam asperiores aspernatur dolorum, ea enim ex laudantium libero molestias numquam pariatur quam qui rem repellendus soluta suscipit ut veniam?Accusantium alias animi asperiores, autem blanditiis consequuntur culpa deleniti distinctio dolore id impedit laudantium mollitia nesciunt non nostrum officia optio placeat praesentium quaerat sed sunt totam unde vero voluptas voluptatem\r\n\r\n', 4, '2024-06-07', 'Powerful Headphones', 55, 44),
(4, 'Gaming Mouse with RGB Lighting', 25, 'A-Brand', 'High precision gaming mouse with customizable RGB lighting.', 1, '2024-06-07', 'RGB ', 61, 21),
(5, 'Wireless Keyboard', 30, 'B-Brand', 'Ergonomic wireless keyboard with long battery life.', 1, '2024-06-07', 'wirless', 35, 31),
(6, 'Portable SSD 500GB', 80, 'C-Brand', 'High-speed portable SSD with 500GB storage capacity.', 2, '2024-06-07', 'high storage', 25, 6),
(7, 'DDR4 RAM 16GB', 75, 'D-Brand', '16GB DDR4 RAM with high-speed performance for gaming and multitasking.', 3, '2024-06-07', 'ram', 39, 21),
(8, 'Noise Cancelling Headphones', 120, 'E-Brand', 'Premium noise-cancelling headphones with high-fidelity sound.', 4, '2024-06-07', 'noise cancel', 0, 0),
(9, 'Mechanical Keyboard', 45, 'F-Brand', 'Mechanical keyboard with tactile switches and RGB backlight.', 1, '2024-06-07', '', 0, 0),
(10, 'External HDD 1TB', 55, 'G-Brand', 'Durable external HDD with 1TB storage capacity.', 2, '2024-06-07', '', 0, 0),
(11, 'Gaming Headset', 35, 'H-Brand', 'Comfortable gaming headset with surround sound and noise cancellation.', 4, '2024-06-07', '', 0, 0),
(12, 'RGB RAM 8GB', 40, 'I-Brand', '8GB RAM with customizable RGB lighting for enhanced gaming experience.', 3, '2024-06-07', '', 0, 0),
(13, 'Wireless Earbuds', 60, 'J-Brand', 'Compact wireless earbuds with high-quality sound and long battery life.', 4, '2024-06-07', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `user_id`, `quantity`) VALUES
(1, 7, 0),
(2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` char(1) NOT NULL DEFAULT 'u'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `address`, `role`) VALUES
(3, 'amrbadran', 'f8ab2d7a690fd197ef52bd465dc826d6c275d403', 'Amr', 'Badran', NULL, 'u'),
(7, 'ahmadmohamed', 'f8ab2d7a690fd197ef52bd465dc826d6c275d403', 'Ahmad', 'Mohammed', NULL, 'u');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_user_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    -- Insert a default entry into the cart table for the new user
    INSERT INTO shopping_cart (user_id) VALUES (NEW.id);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images_product`
--
ALTER TABLE `images_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_product_const` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_const` (`usr_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_cat_const` (`cat_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images_product`
--
ALTER TABLE `images_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images_product`
--
ALTER TABLE `images_product`
  ADD CONSTRAINT `image_product_const` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user_const` FOREIGN KEY (`usr_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
