-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 09:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(30) NOT NULL,
  `category_ids` text NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` text NOT NULL,
  `description` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `image_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_ids`, `title`, `author`, `description`, `qty`, `price`, `image_path`, `date_created`) VALUES
(1, '4,1', 'Sample Book', 'Sample Author', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt dolor in odio aliquet placerat. Mauris vestibulum lacinia justo, at sollicitudin nisi pretium in. Vivamus et ex at purus placerat laoreet faucibus vitae enim. Sed nibh ex, varius congue augue vitae, ullamcorper porta lorem. Praesent ex nunc, faucibus id eros nec, dapibus tempor justo. Ut turpis urna, euismod ac tincidunt vitae, interdum vel purus. Etiam pellentesque leo eget commodo dignissim. Proin ac lorem id lorem euismod posuere eget eget ipsum.', 0, 2500, '1604631420_books-1419613.jpg', '2020-11-06 10:57:51'),
(2, '1,2', 'Python Programming', 'Anthony Brun', 'A Step by Step Guide from Beginner to  Expert', 0, 1800, '1604631960_python_book.jpg', '2020-11-06 11:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `book_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `price` float NOT NULL,
  `customer_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Educational', 'Educational'),
(2, 'Programming', 'Programming'),
(3, 'Fantasy', 'Fantasy'),
(4, 'Business', 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `contact`, `email`, `password`, `date_created`) VALUES
(1, 'John Smith', 'Sample address', '+18456-5455-55', 'jsmith@sample.com', '1254737c076cf867dc53d60a0364f38e', '2020-11-06 12:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `address` text NOT NULL,
  `total_amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address`, `total_amount`, `status`, `date_created`) VALUES
(1, 1, 'Sample address', 0, 1, '2020-11-06 15:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `book_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `book_id`, `qty`, `price`) VALUES
(1, 1, 1, 4, 2500),
(2, 1, 2, 3, 1800);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Online Book Store System', 'info@sample.com', '+18456-5455-55', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt dolor in odio aliquet placerat. Mauris vestibulum lacinia justo, at sollicitudin nisi pretium in. Vivamus et ex at purus placerat laoreet faucibus vitae enim. Sed nibh ex, varius congue augue vitae, ullamcorper porta lorem. Praesent ex nunc, faucibus id eros nec, dapibus tempor justo. Ut turpis urna, euismod ac tincidunt vitae, interdum vel purus. Etiam pellentesque leo eget commodo dignissim. Proin ac lorem id lorem euismod posuere eget eget ipsum.&lt;/p&gt;&lt;p&gt;Nunc tincidunt augue eu ipsum aliquam venenatis. Vestibulum metus nunc, porta quis commodo id, consectetur id ipsum. Phasellus luctus tortor vitae nisl consectetur molestie. Sed varius ornare leo, sit amet faucibus turpis placerat non. Nam ipsum quam, dapibus vitae consequat vitae, molestie nec lacus. Praesent gravida lacus sed pellentesque posuere. Donec tincidunt urna nec magna pulvinar, et viverra leo dictum. Cras aliquet odio ac dapibus porttitor.&lt;/p&gt;&lt;p&gt;Suspendisse sed auctor enim, eu laoreet purus. Fusce aliquam nisl odio, condimentum commodo risus bibendum eu. Proin vitae felis sollicitudin, porta leo sit amet, pretium lorem. Proin facilisis egestas lacus, eu mollis felis egestas eget. Phasellus efficitur accumsan dolor, ut pharetra tortor posuere nec. Phasellus rutrum lacus in purus facilisis tempus. Donec a sapien a dolor varius rutrum in vel velit. Proin mattis porttitor commodo. Nam vitae porta diam, auctor lacinia nibh. Sed sodales commodo suscipit. Suspendisse eu lectus ac ligula fringilla auctor. Donec rutrum, lectus in cursus hendrerit, leo massa dignissim dui, eu tempus lacus est laoreet enim. Nunc lobortis condimentum vulputate.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://localhost/book_store/admin/assets/uploads/1604629260_books-1419613.jpg&quot; style=&quot;width: 465px;&quot; class=&quot;fr-fic fr-dib&quot;&gt;&lt;/p&gt;&lt;p&gt;Curabitur bibendum sem non sagittis sagittis. Fusce ac orci tincidunt, viverra enim id, posuere felis. Cras sed urna elit. Curabitur facilisis odio porta eros facilisis varius. Sed vulputate dolor ac venenatis porta. Suspendisse sit amet odio mollis, porta erat ut, venenatis velit. Nunc sollicitudin lorem vitae purus sodales malesuada. Maecenas pellentesque, nisl sed hendrerit venenatis, tortor augue commodo felis, non cursus risus massa pulvinar sapien. Aliquam vitae nisi et magna condimentum faucibus nec sit amet est. Etiam vulputate iaculis sodales. Fusce ut turpis ut ante laoreet interdum sed ac velit. Suspendisse lacinia felis erat, in lacinia risus volutpat id. Praesent egestas odio diam, ut congue quam sollicitudin laoreet. Aenean elit eros, dapibus id purus blandit, imperdiet vehicula augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam maximus elementum nulla nec consequat.&lt;/p&gt;&lt;p&gt;In aliquam tellus turpis. Etiam pretium ex cursus viverra interdum. Quisque maximus tortor lacus, nec ullamcorper risus bibendum nec. Mauris at ante dui. Vivamus eget suscipit ex. Nullam a purus tincidunt, molestie purus et, placerat enim. Mauris luctus erat sit amet suscipit luctus. Mauris lorem sapien, maximus sit amet varius nec, scelerisque sit amet felis. Phasellus et consequat metus. Sed suscipit aliquet ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer nec pharetra nunc, a pretium libero. Etiam rhoncus ante nibh, a venenatis felis ullamcorper sit amet.&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=Admin,2=Staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
