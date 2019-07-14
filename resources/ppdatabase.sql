-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2019 at 08:02 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT= 0;
START TRANSACTION;
SET time_zone= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pixelpitch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins`
(
  `adminid` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `job_tittle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminid`,`username`, `password`, `email`, `job_tittle`) VALUES
(10, 'staff1', 'staff1', 'staff1@pixelpitch.com', 'admin'),
(11, 'staff2', 'staff2', 'staff2@pixelpitch.com', 'admin'),
(12, 'staff3', 'staff3', 'staff3@pixelpitch.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories`
(
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`,`cat_title`) VALUES
(31, 'Athletic Tee'),
(32, 'Drop Tee'),
(33, 'Leave Your Mark Tee'),
(34, 'Mark Drop Tee'),
(35, 'Motion Tee'),
(36, 'Prime Tee'),
(37, 'Team Tee');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--
CREATE TABLE `customers`
(
  `id` int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
DROP TABLE orders;
CREATE TABLE `orders`
(
  `order_no` int (11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `order_amount` float NOT NULL,
  `order_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `orderDetails`
(
  `order_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  `product_price` int(10) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products`
(
  `product_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--
Delete from products;
INSERT INTO `products` (`product_id`,`product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `product_image`) VALUES
(15, 'Black Athletic Tee', 31, 34, 100, 'The Athletic Tee delivers exceptional comfort and breathability through its polyester and spandex blend. Come with Black Color', 'product_img/athletic_black.jpg'),
(16, 'Blue Athletic Tee', 31, 34, 100, 'The Athletic Tee delivers exceptional comfort and breathability through its polyester and spandex blend.  Come with Blue Color', 'product_img/athletic_blue.jpg'),
(17, 'Grey Athletic Tee', 31, 34, 100, 'The Athletic Tee delivers exceptional comfort and breathability through its polyester and spandex blend. Come with Grey Color', 'product_img/athletic_grey.jpg'),
(18, 'White Athletic Tee', 31, 34, 100, 'The Athletic Tee delivers exceptional comfort and breathability through its polyester and spandex blend.  Come with White Color', 'product_img/athletic_white.jpg'),

(19, 'Black Drop Tee', 32, 34, 100, 'The drop Tee have been designed with both style and comfort in mind. From the soft material to maximise your range of motion to the on trend scoop drop, this product has you covered from the gym to the street. Come with Black Color', 'product_img/drop_black.jpg'),
(20, 'Beige Drop Tee', 32, 33, 100, 'The drop Tee have been designed with both style and comfort in mind. From the soft material to maximise your range of motion to the on trend scoop drop, this product has you covered from the gym to the street.  Come with Beige Color', 'product_img/drop_beige.jpg'),
(21, 'Green Drop Tee', 32, 35, 100, 'The Drop Tee have been designed with both style and comfort in mind. From the soft material to maximise your range of motion to the on trend scoop drop, this product has you covered from the gym to the street. Come with Green Color', 'product_img/drop_green.jpg'),
(22, 'White Drop Tee', 32, 35, 100, 'The Drop Tee have been designed with both style and comfort in mind. From the soft material to maximise your range of motion to the on trend scoop drop, this product has you covered from the gym to the street.  Come with White Color', 'product_img/drop_white.jpg'),

(23, 'Black Leave Your Mark Tee', 33, 32, 100, 'The Leave Your Mark Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look. Come with Black Color', 'product_img/mark_black.jpg'),
(24, 'Blue Leave Your Mark Tee', 33, 34, 100, 'The Leave Your Mark Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look.  Come with Blue Color', 'product_img/mark_blue.jpg'),
(25, 'Green Leave Your Mark Tee', 33, 31, 100, 'The Leave Your Mark Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look. Come with Green Color', 'product_img/mark_green.jpg'),
(26, 'Grey Leave Your Mark Tee', 33, 31, 100, 'The Leave Your Mark Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look.  Come with Grey Color', 'product_img/mark_grey.jpg'),
(27, 'Pink Leave Your Mark Tee', 33, 32, 100, 'The Leave Your Mark Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look.  Come with Pink Color', 'product_img/mark_pink.jpg'),

(28, 'Black Motion Tee', 35, 44, 100, 'The Motion Tee has the sleek, streamlined look, made with our ultra smooth and stretchy performance blend fabric and features a raglan sleeve cut for urban-athletic style. It is completed with contouring seam lines and a tubular body construction for a natural, breathable fit, helping you keep your cool when your workout heats up Come with Black Color', 'product_img/motion_black.jpg'),
(29, 'Blue Motion Tee', 35, 46, 100, 'The Motion Tee has the sleek, streamlined look, made with our ultra smooth and stretchy performance blend fabric and features a raglan sleeve cut for urban-athletic style. It is completed with contouring seam lines and a tubular body construction for a natural, breathable fit, helping you keep your cool when your workout heats up  Come with Blue Color', 'product_img/motion_blue.jpg'),
(30, 'Grey Motion Tee', 35, 45, 100, 'The Motion Tee has the sleek, streamlined look, made with our ultra smooth and stretchy performance blend fabric and features a raglan sleeve cut for urban-athletic style. It is completed with contouring seam lines and a tubular body construction for a natural, breathable fit, helping you keep your cool when your workout heats up Come with Grey Color', 'product_img/motion_grey.jpg'),
(31, 'Red Motion Tee', 35, 43, 100, 'The Motion Tee has the sleek, streamlined look, made with our ultra smooth and stretchy performance blend fabric and features a raglan sleeve cut for urban-athletic style. It is completed with contouring seam lines and a tubular body construction for a natural, breathable fit, helping you keep your cool when your workout heats up  Come with Red Color', 'product_img/motion_red.jpg'),


(32, 'Biege Prime Tee', 36, 31, 100, 'The Prime Tee is a must-have in the Doyoueven range! Featuring a classic t-shirt fit and our iconic branded logo, printed on our signature 95/5 blend of cotton and elastane, the Prime t-shirt is a staple in your active wardrobe providing all day comfort and extreme versatility!  Come with Beige Color', 'product_img/prime_biege.jpg'),
(33, 'Black Prime Tee', 36, 35, 100, 'The Prime Tee is a must-have in the Doyoueven range! Featuring a classic t-shirt fit and our iconic branded logo, printed on our signature 95/5 blend of cotton and elastane, the Prime t-shirt is a staple in your active wardrobe providing all day comfort and extreme versatility!  Come with Black Color', 'product_img/prime_black.jpg'),
(34, 'Blue Prime Tee', 36, 34, 100, 'The Prime Tee is a must-have in the Doyoueven range! Featuring a classic t-shirt fit and our iconic branded logo, printed on our signature 95/5 blend of cotton and elastane, the Prime t-shirt is a staple in your active wardrobe providing all day comfort and extreme versatility!  Come with Blue Color', 'product_img/prime_blue.jpg'),
(35, 'Green Prime Tee', 36, 33, 100, 'The Prime Tee is a must-have in the Doyoueven range! Featuring a classic t-shirt fit and our iconic branded logo, printed on our signature 95/5 blend of cotton and elastane, the Prime t-shirt is a staple in your active wardrobe providing all day comfort and extreme versatility!  Come with Green Color', 'product_img/prime_green.jpg'),
(36, 'Grey Prime Tee', 36, 32, 100, 'The Prime Tee is a must-have in the Doyoueven range! Featuring a classic t-shirt fit and our iconic branded logo, printed on our signature 95/5 blend of cotton and elastane, the Prime t-shirt is a staple in your active wardrobe providing all day comfort and extreme versatility!  Come with Grey Color', 'product_img/prime_grey.jpg'),
(37, 'Maroon Prime Tee', 36, 30, 100, 'The Prime Tee is a must-have in the Doyoueven range! Featuring a classic t-shirt fit and our iconic branded logo, printed on our signature 95/5 blend of cotton and elastane, the Prime t-shirt is a staple in your active wardrobe providing all day comfort and extreme versatility!  Come with Maroon Color', 'product_img/prime_maroon.jpg'),
(38, 'Orange Prime Tee', 36, 3, 100, 'The Prime Tee is a must-have in the Doyoueven range! Featuring a classic t-shirt fit and our iconic branded logo, printed on our signature 95/5 blend of cotton and elastane, the Prime t-shirt is a staple in your active wardrobe providing all day comfort and extreme versatility!  Come with Orange Color', 'product_img/prime_orange.jpg'),

(39, 'Black Team Tee', 37, 28, 100, 'Lets get it team! With a super soft, stretchy, cotton blend material and a classic cut - this tee is a perfect layering option. Whether it be for pumping iron or an outdoor run, this tee is an easy outfit option that is a must have in your activewear wardrobe. Come with Black Color', 'product_img/team_black.jpg'),
(40, 'Blue Team Tee', 37, 28, 100, 'Lets get it team! With a super soft, stretchy, cotton blend material and a classic cut - this tee is a perfect layering option. Whether it be for pumping iron or an outdoor run, this tee is an easy outfit option that is a must have in your activewear wardrobe.  Come with Blue Color', 'product_img/team_blue.jpg'),
(41, 'Grey Team Tee', 37, 28, 100, 'Lets get it team! With a super soft, stretchy, cotton blend material and a classic cut - this tee is a perfect layering option. Whether it be for pumping iron or an outdoor run, this tee is an easy outfit option that is a must have in your activewear wardrobe. Come with Grey Color', 'product_img/team_grey.jpg'),
(42, 'White Team Tee', 37, 28, 100, 'Lets get it team! With a super soft, stretchy, cotton blend material and a classic cut - this tee is a perfect layering option. Whether it be for pumping iron or an outdoor run, this tee is an easy outfit option that is a must have in your activewear wardrobe.  Come with White Color', 'product_img/team_white.jpg'),

(43, 'Black Mark Drop Tee', 34, 34, 100, 'The new Mark Drop Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look. Come with Black Color', 'product_img/markdrop_black.jpg'),
(44, 'Green Mark Drop Tee', 34, 34, 100, 'The new Mark Drop Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look.  Come with Green Color', 'product_img/markdrop_green.jpg'),
(45, 'Grey Mark Drop Tee', 34, 34, 100, 'The new Mark Drop Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look. Come with Grey Color', 'product_img/markdrop_grey.jpg'),
(46, 'White Mark Drop Tee', 34, 34, 100, 'The new Mark Drop Tee is anything but ordinary, utilising back and front dropped hem lines for extended coverage, and a versatile look.  Come with White Color', 'product_img/markdrop_white.jpg')
;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
