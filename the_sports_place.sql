-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 04:07 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_sports_place`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(11) NOT NULL,
  `catname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `catname`) VALUES
(1, 'Team Sports'),
(2, 'Winter Sports'),
(3, 'Outdoor'),
(4, 'Cycling'),
(5, 'Precision Sports'),
(6, 'Racket Sports'),
(7, 'Skates'),
(8, 'Exercise');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(50) NOT NULL,
  `product_full_name` varchar(50) NOT NULL,
  `product_main_category` varchar(20) NOT NULL,
  `product_sub_category` varchar(20) NOT NULL,
  `product_price` float NOT NULL,
  `product_main_image` varchar(500) NOT NULL,
  `product_images` varchar(10000) NOT NULL,
  `product_quantity` int(3) NOT NULL,
  `product_rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_full_name`, `product_main_category`, `product_sub_category`, `product_price`, `product_main_image`, `product_images`, `product_quantity`, `product_rating`) VALUES
(1, 'Oroks 140, Hockey Stick', 'Team Sports', 'Hockey', 24.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/d5f1c868-7342-4b66-b91c-bf99c4a23563_595x.progressive.jpg?v=1561669559', 'https://cdn.shopify.com/s/files/1/1330/6287/products/d5f1c868-7342-4b66-b91c-bf99c4a23563_595x.progressive.jpg?v=1561669559 https://cdn.shopify.com/s/files/1/1330/6287/products/752f62d9-79ea-4d5d-bb41-ef64ac6c9557_740x.progressive.jpg?v=1561669559 https://cdn.shopify.com/s/files/1/1330/6287/products/f3d9550a-f5aa-4d20-95b3-f6e852a9c14e_740x.progressive.jpg?v=1561669559 https://cdn.shopify.com/s/files/1/1330/6287/products/fb467b11-d549-4250-9ea3-c45986d332d8_740x.progressive.jpg?v=1561669559 https://cdn.shopify.com/s/files/1/1330/6287/products/3be19eba-b9fd-4e97-802a-5f8c9bf3e07a_740x.progressive.jpg?v=1561669560 https://cdn.shopify.com/s/files/1/1330/6287/products/641bdd43-4175-47aa-851b-c26e1a01c9c6_740x.progressive.jpg?v=1561669560 https://cdn.shopify.com/s/files/1/1330/6287/products/0503890e-6265-4af9-bed1-aa476ea45aee_740x.progressive.jpg?v=1561669560 https://cdn.shopify.com/s/files/1/1330/6287/products/da93b2a2-df26-4e0e-a06f-18f66bf62de0_740x.progressive.jpg?v=1561669560 ', 3, 1),
(2, 'Oroks 145 L Basic Hockey Bag', 'Team Sports', 'Hockey', 39.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/0266d368-db43-4c5d-81c1-fc66b7ed74d9_595x.progressive.jpg?v=1561669558', 'https://cdn.shopify.com/s/files/1/1330/6287/products/0266d368-db43-4c5d-81c1-fc66b7ed74d9_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/8590c7af-cc42-42ab-9e48-ee0e25a9efa8_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/8ab48d56-4960-41ee-9d0c-d50e7098be86_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/8d4ff630-8b19-47fa-a064-7ac725cc83b5_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/c43cb855-0687-4b5b-a580-5f515c58b6be_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/73840d70-83c4-4827-a7e1-defd80fd1562_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/73840d70-83c4-4827-a7e1-defd80fd1562_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/1ea328bc-92ca-422b-821b-d71084e41bd8_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/4edcf80c-5175-4cdc-932e-7e6967fb0476_595x.progressive.jpg?v=1561669558 https://cdn.shopify.com/s/files/1/1330/6287/products/67dd923a-bc5e-4252-99e0-f6b1c19ed8e9_595x.progressive.jpg?v=1561669558 ', 100, 4),
(3, 'Oxelo Zero, Ice Hockey Skates', 'Team Sports', 'Hockey', 10.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/fda570b8672a45a49f4c6766c2c157ca_595x.progressive.jpg?v=1561669940', 'https://cdn.shopify.com/s/files/1/1330/6287/products/fda570b8672a45a49f4c6766c2c157ca_595x.progressive.jpg?v=1561669940 https://cdn.shopify.com/s/files/1/1330/6287/products/be08be2497194e60b2d40366bed6d510_595x.progressive.jpg?v=1561669940 https://cdn.shopify.com/s/files/1/1330/6287/products/0117e0e1ba31448c8dcab33901b05b2b_595x.progressive.jpg?v=1561669940 https://cdn.shopify.com/s/files/1/1330/6287/products/b2c2ed1357de4b11acbb6b0427308d53_595x.progressive.jpg?v=1561669940 https://cdn.shopify.com/s/files/1/1330/6287/products/1217bf3c9ece4c4ab5be39804f3f8b91_595x.progressive.jpg?v=1561669940 https://cdn.shopify.com/s/files/1/1330/6287/products/285a9918504f4580bc9fe06af7d98bb1_595x.progressive.jpg?v=1561669940 https://cdn.shopify.com/s/files/1/1330/6287/products/22fc7bf532144cac92c0f0c6b34af069_595x.progressive.jpg?v=1561669940 ', 0, 4),
(4, 'Kipsta Essential, 6 Cones, 6-Pack', 'Team Sports', 'Hockey', 9.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/essential_206_20cones_2015cm_20orange_20_7C_20PSHOT_595x.progressive.jpg?v=1629007413', 'https://cdn.shopify.com/s/files/1/1330/6287/products/essential_206_20cones_2015cm_20orange_20_7C_20PSHOT_595x.progressive.jpg?v=1629007413 https://cdn.shopify.com/s/files/1/1330/6287/products/essential_206_20cones_2015cm_20orange_20_7C_20PSHOT_b7ecac09-eb20-4c0d-a23a-278f5b1a966e_595x.progressive.jpg?v=1629007414 https://cdn.shopify.com/s/files/1/1330/6287/products/essential_206_20cones_2015cm_20orange_20_7C_20PSHOT_0c72e9be-5292-4d11-b655-89fbeab8fe6e_595x.progressive.jpg?v=1629007414 https://cdn.shopify.com/s/files/1/1330/6287/products/essential_206_20cones_2015cm_20orange_20_7C_20PSHOT_5fc26b64-442d-4322-ae73-fd32a2a0b580_595x.progressive.jpg?v=1629007414', 0, 5),
(5, 'Kipsta 22.8 Universal Hoop', 'Team Sports', 'Hockey', 7.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/CERCEAU_20UNIVERSEL_2058CM_20ORANGE_5B8350553_5DTCI_PSHOT_000-0001_595x.progressive.jpg?v=1629007405', 'https://cdn.shopify.com/s/files/1/1330/6287/products/CERCEAU_20UNIVERSEL_2058CM_20ORANGE_5B8350553_5DTCI_PSHOT_000-0001_595x.progressive.jpg?v=1629007405 https://cdn.shopify.com/s/files/1/1330/6287/products/CERCEAU_20UNIVERSEL_2058CM_20ORANGE_5B8350553_5DTCI_PSHOT_000-0004_595x.progressive.jpg?v=1629007405 https://cdn.shopify.com/s/files/1/1330/6287/products/CERCEAU_20UNIVERSEL_2058CM_20ORANGE_5B8350553_5DTCI_PSHOT_000-0003_595x.progressive.jpg?v=1629007405', 50, 3),
(6, 'Kids\' Sports Bib', 'Team Sports', 'Hockey', 4.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/KIPSTA_20Chasuble_20enfant_20jaune_20fluo_20SS19_20_7C_20001_20_7C_20PSHOT_20_595x.progressive.jpg?v=1629007550', 'https://cdn.shopify.com/s/files/1/1330/6287/products/KIPSTA_20Chasuble_20enfant_20jaune_20fluo_20SS19_20_7C_20001_20_7C_20PSHOT_20_595x.progressive.jpg?v=1629007550 https://cdn.shopify.com/s/files/1/1330/6287/products/KIPSTA_20Chasuble_20enfant_20jaune_20fluo_20SS19_20_7C_20PSHOT_20_595x.progressive.jpg?v=1629007550 https://cdn.shopify.com/s/files/1/1330/6287/products/KIPSTA_20Chasuble_20enfant_20jaune_20fluo_20SS19_20_7C_20PSHOT_20_85981cd5-1384-4d2e-8609-f8a3b87b66b6_595x.progressive.jpg?v=1629007550 https://cdn.shopify.com/s/files/1/1330/6287/products/KIPSTA_20Chasuble_20enfant_20jaune_20fluo_20SS19_20_7C_20PSHOT_20_ee494e4f-dd31-4875-8492-0c87fe5e049e_595x.progressive.jpg?v=1629007550  https://cdn.shopify.com/s/files/1/1330/6287/products/KIPSTA_20Chasuble_20enfant_20jaune_20fluo_20SS19_20_7C_20PSHOT_20_e7b62700-1161-497d-8dd8-35e73363c2f7_595x.progressive.jpg?v=1629007550 ', 43, 4),
(7, 'Kipsta F100, Soccer Shorts, Adult', 'Team Sports', 'Hockey', 9.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/5f99c9cd-5b50-4b3f-8544-f5350f6d4970_595x.progressive.jpg?v=1561872170', 'https://cdn.shopify.com/s/files/1/1330/6287/products/5f99c9cd-5b50-4b3f-8544-f5350f6d4970_595x.progressive.jpg?v=1561872170 https://cdn.shopify.com/s/files/1/1330/6287/products/3c0e6998-c32f-4205-8661-4d2d03347d8f_595x.progressive.jpg?v=1561872170 https://cdn.shopify.com/s/files/1/1330/6287/products/40e78e07-da36-4a46-b49f-47c055b84b8a_595x.progressive.jpg?v=1561872170 ', 70, 5),
(8, 'Kids\' Mini Basketball Mini', 'Team Sports', 'Basketball', 3.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/Mini_20B_20_ballon_20vert_20_5B8546995_5DTCI_PSHOT_001_20_7C_20001_20_7C_20PSHOT_20_8dbd3784-1cb1-44c8-b083-28707a8222b0_595x.progressive.jpg?v=1621497822', 'https://cdn.shopify.com/s/files/1/1330/6287/products/Mini_20B_20_ballon_20vert_20_5B8546995_5DTCI_PSHOT_001_20_7C_20001_20_7C_20PSHOT_20_8dbd3784-1cb1-44c8-b083-28707a8222b0_595x.progressive.jpg?v=1621497822 https://cdn.shopify.com/s/files/1/1330/6287/products/Mini_20B_20_ballon_20vert_20_5B8546995_5DTCI_PSHOT_002_20_7C_20PSHOT_20_8bce1c8d-1b3f-4aa8-a787-eec17219d2f0_595x.progressive.jpg?v=1621497822 https://cdn.shopify.com/s/files/1/1330/6287/products/Mini_20B_20_ballon_20vert_20_5B8546995_5DTCI_PSHOT_004_20_7C_20PSHOT_20_8c7861bc-4493-4d50-9575-1dbe53581286_595x.progressive.jpg?v=1621497822 https://cdn.shopify.com/s/files/1/1330/6287/products/Mini_20B_20_ballon_20vert_20_5B8546995_5DTCI_PSHOT_003_20_7C_20PSHOT_20_eb718b0b-4cbd-4b3a-9410-e7e2b7222306_595x.progressive.jpg?v=1621497822', 60, 4),
(9, 'Kids\' Basketball Size 5 Wizzy Emblem', 'Team Sports', 'Basketball', 10, 'https://cdn.shopify.com/s/files/1/1330/6287/products/Wizzy_20blason_20rose_20violet_20_7C_20001_20_7C_20PSHOT_20_5fafc11e-ced8-4f54-96d8-3b565ca42553_595x.progressive.jpg?v=1632377957', 'https://cdn.shopify.com/s/files/1/1330/6287/products/Wizzy_20blason_20rose_20violet_20_7C_20001_20_7C_20PSHOT_20_5fafc11e-ced8-4f54-96d8-3b565ca42553_595x.progressive.jpg?v=1632377957 https://cdn.shopify.com/s/files/1/1330/6287/products/Wizzy_20blason_20rose_20violet_20_7C_20002_20_7C_20PSHOT_20_8b477399-c358-425f-a074-3271e26069be_595x.progressive.jpg?v=1632377957 https://cdn.shopify.com/s/files/1/1330/6287/products/Wizzy_20blason_20rose_20violet_20_7C_20005_20_7C_20PSHOT_20_f162f843-9a99-4509-8fb5-7364536b10c1_595x.progressive.jpg?v=1632377957 https://cdn.shopify.com/s/files/1/1330/6287/products/Wizzy_20blason_20rose_20violet_20_7C_20004_20_7C_20PSHOT_20_f0c37fa0-69ad-4c12-8e17-bdb7c272da11_595x.progressive.jpg?v=1632377957', 40, 3),
(10, 'Tarmak B10T0, Beginner Basketball, Size 5', 'Team Sports', 'Basketball', 16.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/BT100_20T5_20_7C_20001_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621435609', 'https://cdn.shopify.com/s/files/1/1330/6287/products/BT100_20T5_20_7C_20001_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621435609 https://cdn.shopify.com/s/files/1/1330/6287/products/BT100_20T5_20_7C_20002_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621435609 https://cdn.shopify.com/s/files/1/1330/6287/products/BT100_20T5_20_7C_20003_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621435609 https://cdn.shopify.com/s/files/1/1330/6287/products/BT100_20T5_20_7C_20004_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621435609 https://cdn.shopify.com/s/files/1/1330/6287/products/BT100_20T5_20_7C_20005_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621435609 ', 90, 5),
(11, 'Tarmak BT500, Grippy Basketball, Size 7', 'Team Sports', 'Basketball', 34.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/BT500X_20Grip_20T7_20marron_20_7C_20001_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497825', 'https://cdn.shopify.com/s/files/1/1330/6287/products/BT500X_20Grip_20T7_20marron_20_7C_20001_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497825 https://cdn.shopify.com/s/files/1/1330/6287/products/BT500X_20Grip_20T7_20marron_20_7C_20002_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497825 https://cdn.shopify.com/s/files/1/1330/6287/products/BT500X_20Grip_20T7_20marron_20_7C_20003_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497825 https://cdn.shopify.com/s/files/1/1330/6287/products/BT500X_20Grip_20T7_20marron_20_7C_20004_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497825 https://cdn.shopify.com/s/files/1/1330/6287/products/BT500X_20Grip_20T7_20marron_20_7C_20005_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497825 https://cdn.shopify.com/s/files/1/1330/6287/products/bt500_20grip_20s7_20black_20_7C_20001_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497837 https://cdn.shopify.com/s/files/1/1330/6287/products/bt500_20grip_20s7_20black_20_7C_20002_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497837 https://cdn.shopify.com/s/files/1/1330/6287/products/bt500_20grip_20s7_20black_20_7C_20003_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497837 https://cdn.shopify.com/s/files/1/1330/6287/products/bt500_20grip_20s7_20black_20_7C_20004_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497837 https://cdn.shopify.com/s/files/1/1330/6287/products/bt500_20grip_20s7_20black_20_7C_20005_20_7C_20PSHOT_20_595x.progressive.jpg?v=1621497837', 3, 5),
(12, 'Kipsta Sunny 300, Soccer Ball, Size 5', 'Team Sports', 'Football', 5.99, 'https://cdn.shopify.com/s/files/1/1330/6287/products/SUNNY_20300_20_20ORANGE_20_7C_20PSHOT_595x.progressive.jpg?v=1630044140', 'https://cdn.shopify.com/s/files/1/1330/6287/products/SUNNY_20300_20_20ORANGE_20_7C_20PSHOT_595x.progressive.jpg?v=1630044140 https://cdn.shopify.com/s/files/1/1330/6287/products/SUNNY_20300_20_20ORANGE_20_7C_20PSHOT_7142de82-dcf9-4c6b-b4c0-5a045f2a06c3_595x.progressive.jpg?v=1630044140 https://cdn.shopify.com/s/files/1/1330/6287/products/SUNNY_20300_20_20ORANGE_20_7C_20PSHOT_3a9835b9-df55-4a14-8999-f09f29db85cc_595x.progressive.jpg?v=1630044140 https://cdn.shopify.com/s/files/1/1330/6287/products/SUNNY_20300_20_20ORANGE_20_7C_20PSHOT_243a9d86-0711-451b-a937-0dd9b7eeb275_595x.progressive.jpg?v=1630044141', 70, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcatid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `subcatname` varchar(30) NOT NULL,
  `subcat_pic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcatid`, `catid`, `subcatname`, `subcat_pic`) VALUES
(1, 1, 'Baseball', 'https://cdn.shopify.com/s/files/1/1330/6287/files/team-sports-baseball-desktop_585x.progressive.jpg?v=6439391475523277960'),
(2, 1, 'Basketball', 'https://cdn.shopify.com/s/files/1/1330/6287/files/team-sports-basketball-desktop_585x.progressive.jpg?v=8236526773775172141'),
(3, 1, 'Soccer', 'https://cdn.shopify.com/s/files/1/1330/6287/files/team-sports-soccer-desktop_585x.progressive.jpg?v=1314341899084727670'),
(4, 1, 'Volleyball', 'https://cdn.shopify.com/s/files/1/1330/6287/files/team-sports-volleyball-desktop_585x.progressive.jpg?v=2147988630307584335'),
(5, 1, 'HandBall', 'https://cdn.shopify.com/s/files/1/1330/6287/files/team-sports-handball-desktop_585x.progressive.jpg?v=2844685315008484998'),
(6, 1, 'Hockey', 'https://cdn.shopify.com/s/files/1/1330/6287/files/team-sports-hockey-desktop_585x.progressive.jpg?v=10676928030555122374'),
(7, 1, 'Rugby', 'https://cdn.shopify.com/s/files/1/1330/6287/files/team-sports-rugby-desktop_585x.progressive.jpg?v=10888258387310005101'),
(8, 6, 'Badminton', ''),
(9, 6, 'Squash', ''),
(10, 6, 'Swingball', ''),
(11, 6, 'Tennis', ''),
(12, 6, 'Table Tennis', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `first_name`, `last_name`, `user_password`) VALUES
(7, 'joyaljoseneutron@gmail.com', 'JOYAL', 'JOSE', 'dab10da976c19d47767e6ac06bd74762b55a514e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcatid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
