-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 01:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dacs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbill`
--

CREATE TABLE `tblbill` (
  `user` varchar(50) NOT NULL,
  `seat` varchar(4) NOT NULL,
  `movie_name` text NOT NULL,
  `total` int(11) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbill`
--

INSERT INTO `tblbill` (`user`, `seat`, `movie_name`, `total`, `code`) VALUES
('vũ', 'E5', 'QUỶ ÁM', 150, '66b5f9b4ba1f1');

-- --------------------------------------------------------

--
-- Table structure for table `tblmovie`
--

CREATE TABLE `tblmovie` (
  `movie_id` int(50) NOT NULL,
  `movie_name` varchar(50) NOT NULL,
  `image_movie` text NOT NULL,
  `describe_movie` text NOT NULL,
  `date` date NOT NULL,
  `number_tickets_sold` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `status_movie` varchar(10) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `thoiLuong` int(10) NOT NULL,
  `daoDien` text NOT NULL,
  `doanhThu` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblmovie`
--

INSERT INTO `tblmovie` (`movie_id`, `movie_name`, `image_movie`, `describe_movie`, `date`, `number_tickets_sold`, `price`, `status_movie`, `screen_id`, `thoiLuong`, `daoDien`, `doanhThu`) VALUES
(1, 'QUỶ ÁM', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/quy-am-tin-do.jpg', 'Phần tiếp theo của bộ phim năm 1973 kể về một cô bé 12 tuổi bị ám bởi một thực thể ma quỷ bí ẩn, buộc mẹ cô phải tìm đến sự giúp đỡ của hai linh mục để cứu cô.', '2024-07-15', '', '45000', 'playing', 1, 75, 'Leslie Odom Jr., Ellen Burstyn, Lidya Jewett, Olivia Marcum, Ann Dowd', 664150),
(2, 'ĐẤT RỪNG PHƯƠNG NAM (K)', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/poster-dat-rung-phuong-nam.jpg', 'Sau bao ngày chờ đợi, dự án điện ảnh gợi ký ức tuổi thơ của nhiều thế hệ người Việt chính thức tung hình ảnh đầu tiên đầy cảm xúc. First look poster khắc họa hình ảnh đối lập: bé An đang ôm chặt mẹ giữa một khung cảnh chạy giặc loạn lạc. Cùng chờ đợi và theo dõi thêm hành trình bé An đi tìm cha khắp nam kỳ lục tỉnh cùng các người bạn đồng hành nhé!', '2024-07-16', '', '45000', 'playing', 2, 80, 'Nguyễn Quang Dũng', 0),
(3, 'KRAVEN THỢ SĂN THỦ LĨNH', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/kraven.jpg', 'Gã nhập cư Nga Sergei Kravinoff đang thực hiện nhiệm vụ chứng minh rằng anh ta là thợ săn vĩ đại nhất thế giới.', '2024-07-16', '', '45000', 'playing', 3, 80, 'J.C. Chandor', 1040000),
(4, 'MỸ NHÂN ĐẠO CHÍCH', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/my-nhan-dao-chich.jpg', 'Cặp mẹ con “đạo chích” Ji Hye - Joo Yeong từng thực hiện vô số phi vụ thành công, nhưng mà là… công cốc. Để khép lại sự nghiệp không mấy vẻ vang này, Ji Hye lên kế hoạch trộm số vàng với giá trị lên đến 60 tỷ Won bằng cách lợi dụng trái tim mong manh mới biết yêu của anh chàng tài phiệt Wan Gyu. Nhưng phi vụ đặc biệt này không hề suôn sẻ khi cũng có những kẻ khác đang nhòm ngó số vàng kếch xù này.', '2024-07-16', '', '45000', 'playing', 4, 80, 'Lee Seung-Joon', 0),
(5, 'MỸ NHÂN ĐẠO CHÍCH 2', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/my-nhan-dao-chich.jpg', 'Cặp mẹ con “đạo chích” Ji Hye - Joo Yeong từng thực hiện vô số phi vụ thành công, nhưng mà là… công cốc. Để khép lại sự nghiệp không mấy vẻ vang này, Ji Hye lên kế hoạch trộm số vàng với giá trị lên đến 60 tỷ Won bằng cách lợi dụng trái tim mong manh mới biết yêu của anh chàng tài phiệt Wan Gyu. Nhưng phi vụ đặc biệt này không hề suôn sẻ khi cũng có những kẻ khác đang nhòm ngó số vàng kếch xù này.', '2024-07-16', '', '45000', 'comming', 4, 80, 'Lee Seung-Joon', 0),
(6, 'QUỶ ÁM 2', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/quy-am-tin-do.jpg', 'Phần tiếp theo của bộ phim năm 1973 kể về một cô bé 12 tuổi bị ám bởi một thực thể ma quỷ bí ẩn, buộc mẹ cô phải tìm đến sự giúp đỡ của hai linh mục để cứu cô.', '2024-07-14', '', '45000', 'comming', 1, 75, 'Leslie Odom Jr., Ellen Burstyn, Lidya Jewett, Olivia Marcum, Ann Dowd', 0),
(7, 'ĐẤT RỪNG PHƯƠNG NAM 2 (K)', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/poster-dat-rung-phuong-nam.jpg', 'Sau bao ngày chờ đợi, dự án điện ảnh gợi ký ức tuổi thơ của nhiều thế hệ người Việt chính thức tung hình ảnh đầu tiên đầy cảm xúc. First look poster khắc họa hình ảnh đối lập: bé An đang ôm chặt mẹ giữa một khung cảnh chạy giặc loạn lạc. Cùng chờ đợi và theo dõi thêm hành trình bé An đi tìm cha khắp nam kỳ lục tỉnh cùng các người bạn đồng hành nhé!', '2024-07-16', '', '45000', 'comming', 2, 80, 'Nguyễn Quang Dũng', 0),
(8, 'KRAVEN THỢ SĂN THỦ LĨNH 2', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/kraven.jpg', 'Gã nhập cư Nga Sergei Kravinoff đang thực hiện nhiệm vụ chứng minh rằng anh ta là thợ săn vĩ đại nhất thế giới.', '2024-07-16', '', '45000', 'comming', 3, 80, 'J.C. Chandor', 0),
(9, 'HÀNH TINH CÁT PHẦN 2', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/dune-poster.jpg', 'Dune: Hành tinh cát - Phần hai là bộ phim sử thi khoa học viễn tưởng của Mỹ ra mắt năm 2023 do Denis Villeneuve đạo diễn vởi kịch bản do Villeneuve, Jon Spaihts và Eric Roth cùng chấp bút.', '2024-07-15', '', '45000', 'playing', 5, 80, 'Denis Villeneuve', 45000),
(10, 'HÀNH TINH CÁT PHẦN 3', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/dune-poster.jpg', 'Dune: Hành tinh cát - Phần hai là bộ phim sử thi khoa học viễn tưởng của Mỹ ra mắt năm 2023 do Denis Villeneuve đạo diễn vởi kịch bản do Villeneuve, Jon Spaihts và Eric Roth cùng chấp bút.', '2024-07-15', '', '45000', 'comming', 5, 80, 'Denis Villeneuve', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblscreen`
--

CREATE TABLE `tblscreen` (
  `screen_id` int(11) NOT NULL,
  `movie_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblseat`
--

CREATE TABLE `tblseat` (
  `seat_id` int(11) NOT NULL,
  `seat_name` varchar(5) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblseat`
--

INSERT INTO `tblseat` (`seat_id`, `seat_name`, `screen_id`, `status`) VALUES
(1, 'A1', 2, 'available'),
(2, 'A2', 2, 'available'),
(3, 'A3', 2, 'unavailable'),
(4, 'A4', 3, 'unavailable'),
(5, 'A5', 3, 'unavailable'),
(6, 'B1', 3, 'unavailable'),
(7, 'B2', 4, 'unavailable'),
(8, 'B3', 4, 'unavailable'),
(9, 'B4', 4, 'available'),
(10, 'C1', 5, 'available'),
(11, 'C2', 5, 'available'),
(12, 'C3', 5, 'unavailable'),
(13, 'C4', 6, 'available'),
(14, 'D1', 6, 'available'),
(15, 'D2', 6, 'available'),
(16, 'D3', 7, 'available'),
(17, 'D4', 7, 'available'),
(18, 'E1', 7, 'available'),
(19, 'E2', 7, 'available'),
(20, 'E3', 7, 'available'),
(41, 'A1', 1, 'unavailable'),
(42, 'A2', 1, 'unavailable'),
(43, 'A3', 1, 'unavailable'),
(44, 'A4', 1, 'unavailable'),
(45, 'A5', 1, 'unavailable'),
(46, 'B1', 1, 'unavailable'),
(47, 'B2', 1, 'unavailable'),
(48, 'B3', 1, 'unavailable'),
(49, 'B4', 1, 'unavailable'),
(50, 'B5', 1, 'available'),
(51, 'C1', 1, 'available'),
(52, 'C2', 1, 'available'),
(53, 'C3', 1, 'unavailable'),
(54, 'C4', 1, 'available'),
(55, 'C5', 1, 'available'),
(56, 'D1', 1, 'available'),
(57, 'D2', 1, 'available'),
(58, 'D3', 1, 'available'),
(59, 'D4', 1, 'unavailable'),
(60, 'D5', 1, 'available'),
(61, 'E1', 1, 'available'),
(62, 'E2', 1, 'available'),
(63, 'E3', 1, 'unavailable'),
(64, 'E4', 1, 'available'),
(65, 'E5', 1, 'unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `tblshowtime`
--

CREATE TABLE `tblshowtime` (
  `showtime_id` int(11) NOT NULL,
  `thoiGian` time NOT NULL,
  `date` date NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblshowtime`
--

INSERT INTO `tblshowtime` (`showtime_id`, `thoiGian`, `date`, `movie_id`) VALUES
(1, '12:00:00', '2024-07-05', 1),
(2, '22:52:00', '2024-07-10', 1),
(3, '14:00:00', '2024-07-05', 1),
(4, '15:00:00', '2024-07-05', 1),
(5, '04:00:00', '2024-07-15', 2),
(6, '07:00:00', '2024-07-15', 2),
(7, '08:00:00', '2024-07-15', 3),
(8, '17:00:00', '2024-07-15', 3),
(9, '09:00:00', '2024-07-15', 4),
(10, '20:10:00', '2024-07-22', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tblticket`
--

CREATE TABLE `tblticket` (
  `id` int(11) NOT NULL,
  `movie` varchar(255) NOT NULL,
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  `seat` varchar(255) NOT NULL,
  `food` varchar(255) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `userName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblticket`
--

INSERT INTO `tblticket` (`id`, `movie`, `DATE`, `TIME`, `seat`, `food`, `total_price`, `userName`) VALUES
(1, 'QUỶ ÁM', '2024-07-10', '22:52:00', 'E3', '[]', 45, ''),
(2, 'QUỶ ÁM', '2024-07-05', '12:00:00', 'D4', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":1,\"COMBO PARTY\":0}', 150, ''),
(3, 'QUỶ ÁM', '2024-07-05', '12:00:00', 'B4', '{\"COMBO SOLO\":1,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 129, ''),
(5, 'QUỶ ÁM', '2024-07-05', '12:00:00', 'A1', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(6, 'QUỶ ÁM', '2024-07-05', '14:00:00', 'A2', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(7, 'QUỶ ÁM', '2024-07-10', '22:52:00', 'B2', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(8, 'QUỶ ÁM', '2024-07-10', '22:52:00', 'B1', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":1,\"COMBO PARTY\":0}', 195000, 'baso'),
(9, 'QUỶ ÁM', '2024-07-10', '22:52:00', 'A5', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":1,\"COMBO PARTY\":0}', 195000, 'baso'),
(10, 'QUỶ ÁM', '2024-07-15', '09:00:00', 'B3', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(11, 'QUỶ ÁM', '2024-07-15', '17:00:00', 'B1', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":1}', 244000, 'vũ'),
(12, 'QUỶ ÁM', '2024-07-15', '09:00:00', 'B2', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(13, 'QUỶ ÁM', '2024-07-15', '17:00:00', 'A4', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(14, '9', '2024-07-22', '20:10:00', 'C3', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(15, '3', '2024-07-15', '17:00:00', 'A5', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":5}', 1040000, 'vũ'),
(16, '1', '2024-07-05', '12:00:00', 'A3', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":0,\"COMBO PARTY\":0}', 45000, 'vũ'),
(17, '1', '2024-07-05', '12:00:00', 'E5', '{\"COMBO SOLO\":0,\"COMBO COUPLE\":1,\"COMBO PARTY\":0}', 150, 'vũ');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `token` text NOT NULL,
  `leveluser` varchar(50) NOT NULL,
  `userName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `email`, `password`, `token`, `leveluser`, `userName`) VALUES
(17, 'concoko35@gmail.com', '$2y$10$KUp0dFIB24KIpH4GiZiDE.NnnmMxGYOSRDj2Od0e4.LPuC/g2pDuG', 'Toikoco_12345', '0', 'I trust U'),
(18, 'nguyenvu00304@gmail.com', '$2y$10$yK2tUvsibOdhg4aB8uZij.O/ISAQwpjuDfcOk1qh0WyEl73l01q/i', '25042003Vu_', '1', 'vũ'),
(19, 'pimpompimpom4@gmail.com', '$2y$10$8BPFBw89r1dmd2WYtKGEiuA.QNYtW6SDyk3zh4alXltHMIz/UBZrS', '123456P_', '0', 'baso');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblmovie`
--
ALTER TABLE `tblmovie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `tblscreen`
--
ALTER TABLE `tblscreen`
  ADD PRIMARY KEY (`screen_id`);

--
-- Indexes for table `tblseat`
--
ALTER TABLE `tblseat`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `tblshowtime`
--
ALTER TABLE `tblshowtime`
  ADD PRIMARY KEY (`showtime_id`);

--
-- Indexes for table `tblticket`
--
ALTER TABLE `tblticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblscreen`
--
ALTER TABLE `tblscreen`
  MODIFY `screen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblseat`
--
ALTER TABLE `tblseat`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tblshowtime`
--
ALTER TABLE `tblshowtime`
  MODIFY `showtime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblticket`
--
ALTER TABLE `tblticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
