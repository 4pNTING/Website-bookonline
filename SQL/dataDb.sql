-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 27, 2024 at 02:28 AM
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
-- Database: `dataDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `orderID` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `pro_id` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `orderPrice` float DEFAULT NULL,
  `orderQty` int(11) DEFAULT NULL,
  `Total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `orderID`, `pro_id`, `orderPrice`, `orderQty`, `Total`) VALUES
(1, 0000000003, 000001, 150000, 1, 150000),
(2, 0000000003, 000004, 250000, 1, 250000),
(3, 0000000003, 000007, 120000, 1, 120000),
(4, 0000000004, 000001, 150000, 1, 150000),
(5, 0000000005, 000001, 150000, 10, 1500000),
(6, 0000000006, 000001, 150000, 10, 1500000),
(7, 0000000007, 000002, 150000, 2, 300000),
(8, 0000000008, 000003, 250000, 10, 2500000),
(9, 0000000009, 000001, 150000, 10, 1500000),
(10, 0000000010, 000005, 250000, 15, 3750000),
(11, 0000000011, 000004, 250000, 1, 250000),
(12, 0000000011, 000001, 150000, 1, 150000),
(13, 0000000012, 000002, 150000, 2, 300000),
(14, 0000000013, 000001, 150000, 1, 150000),
(15, 0000000014, 000003, 250000, 1, 250000),
(16, 0000000015, 000001, 150000, 1, 150000),
(17, 0000000016, 000002, 150000, 1, 150000),
(18, 0000000017, 000002, 150000, 1, 150000),
(19, 0000000018, 000002, 150000, 2, 300000),
(20, 0000000019, 000002, 150000, 2, 300000),
(21, 0000000020, 000003, 250000, 2, 500000),
(22, 0000000021, 000002, 150000, 2, 300000),
(23, 0000000022, 000003, 250000, 7, 1750000),
(24, 0000000022, 000002, 150000, 7, 1050000),
(25, 0000000023, 000002, 150000, 2, 300000),
(26, 0000000024, 000002, 150000, 1, 150000),
(27, 0000000025, 000003, 250000, 1, 250000),
(28, 0000000026, 000004, 250000, 5, 1250000),
(29, 0000000026, 000008, 120000, 5, 600000),
(30, 0000000026, 000007, 120000, 4, 480000),
(31, 0000000027, 000006, 350000, 2, 700000),
(32, 0000000028, 000004, 250000, 2, 500000),
(33, 0000000028, 000007, 120000, 2, 240000),
(34, 0000000028, 000005, 250000, 2, 500000),
(35, 0000000028, 000019, 40000, 1, 40000),
(36, 0000000029, 000004, 250000, 3, 750000),
(37, 0000000029, 000007, 120000, 3, 360000),
(38, 0000000029, 000008, 120000, 2, 240000),
(39, 0000000030, 000004, 250000, 15, 3750000),
(40, 0000000031, 000004, 250000, 20, 5000000),
(41, 0000000032, 000008, 120000, 27, 3240000),
(42, 0000000033, 000002, 150000, 22, 3300000),
(43, 0000000034, 000003, 250000, 22, 5500000),
(44, 0000000035, 000004, 250000, 2, 500000),
(45, 0000000035, 000005, 250000, 3, 750000),
(46, 0000000035, 000006, 350000, 4, 1400000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `orderID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `pay_money` float NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` time NOT NULL,
  `pay_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`orderID`, `pay_money`, `pay_date`, `pay_time`, `pay_image`) VALUES
(0000000001, 100000, '2024-10-20', '12:30:00', '67155b92c153fb_jpeg'),
(0000000006, 0, '2024-10-21', '14:42:00', '671602034c348b_671602034c412.jpeg'),
(0000000007, 300000, '2024-10-21', '14:23:00', '6716a5c6ea460b_6716a5c6ea465.jpeg'),
(0000000009, 1500000, '2024-10-14', '23:21:00', '6716a61e1bff9b_6716a61e1bfff.jpeg'),
(0000000016, 0, '2024-10-20', '14:23:00', '67155f61562f7b_jpeg'),
(0000000018, 0, '2024-10-20', '11:23:00', '6715607a38525b_jpeg'),
(0000000020, 500000, '2024-10-21', '23:23:00', '6716a4db5e3acb_6716a4db5e3b2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` varchar(6) NOT NULL,
  `pro_name` varchar(30) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `type_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `price` float DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `detail`, `type_id`, `price`, `amount`, `image`) VALUES
('000001', 'Java', 'Java shot', 003, 250250, 10, '67421d47cba9e.jpg'),
('000002', 'Java', 'Java', 001, 150000, 10, '1728016640.jpeg'),
('000003', 'React', 'Java', 001, 250000, 8, '1728016653.jpeg'),
('000004', 'React', 'Java', 001, 250000, 0, '1728016669.jpg'),
('000005', 'React', 'Java', 001, 250000, 80, '1728016673.jpg'),
('000006', 'PHP', 'Java', 001, 350000, 14, '1728016692.jpeg'),
('000007', 'PHP', 'Java', 001, 120000, 87, '1728016706.jpeg'),
('000008', 'PHP001', 'Java', 001, 120000, -13, '1728016718.jpeg'),
('000012', 'ປີ້ງປາ', NULL, 005, 25000, 20, '670bc3bee98cb.jpeg'),
('000013', '4pN Hello Motherfucker', NULL, 003, 2222, 222, '670bc3eabcdf8.jpeg'),
('000014', '4pN Hello Motherfucker', NULL, 003, 10000, 20, '670bc4065b161.jpeg'),
('000015', 'ປີ້ງປາ', NULL, 003, 2222, 2222, '670bc7dec205b.jpeg'),
('000016', 'Lactasoy', NULL, 005, 8000, 30, '670ebe2847a11.jpeg'),
('000017', 'Script', NULL, 002, 13000, 20, '670ec26a40705.jpeg'),
('000018', 'Nutrition', '300%', 005, 25000, 30, '670ec5274d7d6.jpeg '),
('000019', 'ແຊບອະມີໂນ', 'ແກັດແນວ', 005, 40000, 29, '670ec6d118e7b.jpeg'),
('P00018', 'ອານຫານໝາ', 'ອານຫານໝາ', 005, 25000, 20, '670f9efd91664.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marks`
--

CREATE TABLE `tbl_marks` (
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(35) NOT NULL,
  `marks` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_marks`
--

INSERT INTO `tbl_marks` (`student_id`, `student_name`, `marks`) VALUES
(1, 'John', 39),
(2, 'Mary ', 46),
(3, 'Maya', 65),
(4, 'Rahul', 90),
(5, 'Priya', 75);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id`, `firstname`, `lastname`, `address`, `telephone`, `username`, `password`) VALUES
(000001, 'cusname', 'cusname', 'vientiane', 209989999, 'cusname', 123456),
(000001, 'cusname', 'cusname', 'vientiane', 209989999, 'cusname', 123456),
(000002, 'lao', 'lao', 'lao', 111111, 'lao111', 123456),
(000002, 'lao', 'lao', 'lao', 111111, 'lao111', 123456);

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `firstname` varchar(30) NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(30) NOT NULL,
  `telephone` int(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` varchar(1) NOT NULL COMMENT 'status 0 = user 1 = admin\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`id`, `firstname`, `lastname`, `telephone`, `username`, `password`, `status`) VALUES
(000001, '4pN1', 'Motherfucker', 2054134451, '40mg41', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', '1'),
(000002, '4pN', 'Motherfucker', 2054134451, '40mg42', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '1'),
(000003, '4pN43', 'Motherfucker', 2054134451, '40mg43', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '0'),
(000004, '4pN', 'Motherfucker', 2054134451, '40mg44', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '0'),
(000005, '4pN', 'Motherfucker', 2054134451, '40mg40', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '0'),
(000006, '4pN', 'Motherfucker', 2054134451, '40mg40', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '0'),
(000007, '4pN', 'Motherfucker', 2054134451, '40mg40', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '0'),
(000008, 'lao', 'lao', 999999, 'shadow4', '123456', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `orderID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `cus_id` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'ລະຫັດລູກຄ້າ\r\n',
  `cus_name` varchar(60) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `order_status` varchar(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateMonth` varchar(30) NOT NULL COMMENT 'Month'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`orderID`, `cus_id`, `cus_name`, `address`, `telephone`, `total_price`, `order_status`, `reg_date`, `dateMonth`) VALUES
(0000000001, 0000000001, 'ພັດສະລະຈັນທິລາດ', 'LAOS', '02099899098', 520000, '1', '2024-10-04 04:39:52', ''),
(0000000002, 0000000002, 'ພັດສະລະຈັນທິລາດ', 'LAOS', '02099899098', 520000, '1', '2024-10-04 04:42:18', ''),
(0000000003, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'LAOS', '02099899098', 520000, '0', '2024-10-04 04:43:30', ''),
(0000000004, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'lao', '0209993232323', 150000, '1', '2024-10-04 04:44:31', ''),
(0000000005, 0000000000, 'ພັດສະລະຈັນທິລາດ-11', 'lao', '02099899809', 1500000, '1', '2024-10-04 16:38:34', ''),
(0000000006, 0000000000, 'dd', 'dsad', '02099899098', 1500000, '0', '2024-10-04 16:39:21', ''),
(0000000007, 0000000000, 'ພັດສະລະຈັນທິລາດ', '2323', '02099899809', 300000, '1', '2024-10-04 16:40:08', ''),
(0000000008, 0000000000, 'ພັດສະລະຈັນທິລາດsdsadsads', 'lao', '02099899098', 2500000, '0', '2024-10-04 16:40:51', ''),
(0000000009, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'lao1', '02099899098', 1500000, '1', '2024-10-04 16:48:16', ''),
(0000000010, 0000000000, 'ພັດສະລະຈັນທິລາດ', '10001', '02099899098', 3750000, '2', '2024-10-04 16:48:59', ''),
(0000000011, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'lao', '02099899098', 400000, '0', '2024-10-04 17:44:46', ''),
(0000000012, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'lao', '02099899098', 300000, '1', '2024-10-04 17:45:20', ''),
(0000000013, 0000000000, 'pop', 'laos', '02099899098', 150000, '2', '2024-10-04 17:54:43', ''),
(0000000014, 0000000000, 'ວັດສະລະ ຈັນທິລາດ', 'ກຳແພງນະຄອນຫຼວງວຽງຈັນ', '02099899098', 250000, '0', '2024-10-04 20:23:55', ''),
(0000000015, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'ກຳແພງນະຄອນຫຼວງວຽງຈັນ', '02099899098', 150000, '0', '2024-10-04 20:28:09', ''),
(0000000016, 0000000000, 'ພັດສະລະຈັນທິລາດ-11', 'laos', '02099899809', 150000, '2', '2024-10-04 20:33:53', ''),
(0000000017, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'vientiane', '02099899098', 150000, '1', '2024-10-10 01:32:13', ''),
(0000000018, 0000000000, 'ພັດສະລະຈັນທິລາດ', ' $sMessage .= \"ຊື່ລູກຄ້າ \" . $pname . \"\n\";', '020999999', 300000, '1', '2024-10-10 01:33:58', ''),
(0000000019, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'dsad', '20220202022', 300000, '2', '2024-10-10 01:36:08', ''),
(0000000020, 0000000000, 'ພັດສະລະຈັນທິລາດ', '020', '02099090090', 500000, '1', '2024-10-10 01:39:31', ''),
(0000000021, 0000000000, 'LOL', 'LAOS', '02099899098', 300000, '2', '2024-10-10 02:59:27', ''),
(0000000022, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'LAOS', '02099899922', 2800000, '1', '2024-10-11 00:59:00', ''),
(0000000023, 0000000000, 'ພັດສະລະຈັນທິລາດ', 'LAOS', '0209999999', 300000, '1', '2024-10-11 01:13:16', ''),
(0000000024, 0000000000, 'LAOS', 'LAOS', '02099099090', 150000, '1', '2024-10-11 01:27:00', ''),
(0000000025, 0000000000, 'LAOS', 'LAOS', '02099099090', 250000, '1', '2024-10-12 01:56:17', 'October'),
(0000000026, 0000000001, 'cusname cusname', 'vientiane', '209989999', 2330000, '3', '2024-10-22 19:20:10', 'October'),
(0000000027, 0000000000, 'lao lao', 'lao', '111111', 700000, '1', '2024-10-25 11:09:23', 'October'),
(0000000028, 0000000000, 'noy', 'watt', '77218999', 1280000, '1', '2024-10-25 11:23:18', 'October'),
(0000000029, 0000000001, 'cusname cusname', 'vientiane', '209989999', 1350000, '0', '2024-10-28 19:41:29', 'October'),
(0000000030, 0000000001, 'cusname cusname', 'vientiane', '209989999', 3750000, '0', '2024-10-30 13:04:32', 'October'),
(0000000031, 0000000001, 'cusname cusname', 'vientiane', '209989999', 5000000, '0', '2024-10-30 13:06:53', 'October'),
(0000000032, 0000000001, 'cusname cusname', 'vientiane', '209989999', 3240000, '1', '2024-10-30 13:59:55', 'October'),
(0000000033, 0000000001, 'cusname cusname', 'vientiane', '209989999', 3300000, '1', '2024-10-30 14:25:13', 'October'),
(0000000034, 0000000001, 'cusname cusname', 'vientiane', '209989999', 5500000, '1', '2024-10-30 14:28:30', 'October'),
(0000000035, 0000000001, 'cusname cusname', 'vientiane', '209989999', 2650000, '1', '2024-10-30 14:32:04', 'October');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `type_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(001, 'ໜັງສື'),
(002, 'ເຄືອງໃຊ້ໄຟຟ້າ'),
(003, 'ຄອມພິເຕີ'),
(004, 'ເຄື່ອງໄຟຟ້າ'),
(005, 'ອາຫານ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tbl_marks`
--
ALTER TABLE `tbl_marks`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_marks`
--
ALTER TABLE `tbl_marks`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `orderID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `tb_order` (`orderID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
